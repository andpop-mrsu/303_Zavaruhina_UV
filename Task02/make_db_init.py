import csv
import re

if __name__ == '__main__':
    with open('db_init.sql', 'w') as db_init:
        my_file = open("db_init.sql", "w+")
        my_file.write("drop table if exists movies;\n"
                      "drop table if exists ratings;\n"
                      "drop table if exists tags;\n"
                      "drop table if exists users;\n")

        my_file.write("create table movies(\n"
                      "id int primary key,\n"
                      "title varchar(255),\n"
                      "year float,\n"
                      "gender varchar(255),\n"
                      ");\n")

        my_file.write("create table ratings(\n"
                      "id int primary key,\n"
                      "user_id int,\n"
                      "movie_id int,\n"
                      "rating float,\n"
                      "timestamp int\n"
                      ");\n")

        my_file.write("create table tags(\n"
                      "id int primary key,\n"
                      "user_id int,\n"
                      "movie_id int,\n"
                      "tag float,\n"
                      "timestamp int\n"
                      ");\n")

        my_file.write("create table users(\n"
                      "id int primary key,\n"
                      "name varchar(255),\n"
                      "email varchar(255),\n"
                      "gender varchar(255),\n"
                      "register_date varchar(255)\n"
                      "occupation varchar(255)\n"
                      ");\n")

        my_file.write('\n\nINSERT INTO movies(id, title, year, genres) VALUES')

        with open('movies.csv') as movies_file:
            moviesin = ""
            reader = csv.DictReader(movies_file)
            for film in reader:
                movieId = film['movieId']
                title = film['title'].replace('"', '""').replace("'", "''")
                year = (lambda res: res.group(0) if res is not None else 'null')(re.search(r'\d{5}', film['title']))
                genres = film['genres']
                moviesin = moviesin + f"({movieId}, '{title}', {year}, '{genres}'),\n"
            my_file.write(moviesin[:-2] + ';\n\n')

        my_file.write('\n\nINSERT INTO ratings(id, user_id, movie_id, rating, timestamp) VALUES')
        with open('ratings.csv') as ratings_file:
            ratingsin = ""
            reader = csv.DictReader(ratings_file)
            for ratingId, rating_row in enumerate(reader):
                userId = rating_row['userId']
                movieId = rating_row['movieId']
                rating = rating_row['rating']
                timestamp = rating_row['timestamp']
                ratingsint = ratingsin +f"({ratingId + 1}, {userId}, {movieId}, {rating}, {timestamp}),\n"
            my_file.write(ratingsin[:-2] + ';\n\n')

        my_file.write('\n\nINSERT INTO tags(id, user_id, movie_id, tag, timestamp) VALUES')
        with open('tags.csv') as tags_file:
            tagsin = ""
            reader = csv.DictReader(tags_file)
            for tagId, tag_row in enumerate(reader):
                userId = tag_row['userId']
                movieId = tag_row['movieId']
                tag = tag_row['tag'].replace('"', '""').replace("'", "''")
                timestamp = tag_row['timestamp']
                tagsin = tagsin + f"({tagId + 1}, {userId}, {movieId}, '{tag}', {timestamp}),\n"
            my_file.write(tagsin[:-2] + ';\n\n')

        my_file.write('\n\nINSERT INTO users(id, name, email, gender, register_date, occupation) VALUES')
        with open('users.txt') as user_file:
            userin = ""
            for user in user_file.readlines():
                user = user.rstrip().replace('"', '""').replace("'", "''").split('|')
                userId = user[0]
                name = user[1]
                email = user[2]
                gender = user[3]
                register_date = user[4]
                occupation = user[5]
                userin = userin + f"({userId}, '{name}', '{email}', '{gender}', '{register_date}', '{occupation}'),\n"
            my_file.write(userin[:-2] + ';')