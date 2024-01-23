#! /bin/bash

DB_USER=root
DB_HOST=localhost

mysql_cmd="mysql -h $DB_HOST -u $DB_USER -p"

MYSQL_DATABASE=${1:-"quiz_db"}

echo $MYSQL_DATABASE
create_db_query="CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;"

create_db_cmd="$mysql_cmd -e \"$create_db_query\""
# CREATE_TABLE=mysql -h localhost -u root -p -D quiz_db -e $query

# $create_db_cmd
echo $create_db_cmd
echo
eval $create_db_cmd
echo Database $MYSQL_DATABASE created successfully...........
# ----------------------------------------------------------------------------------------------------------------

quiz_query_cmd="$mysql_cmd -D $MYSQL_DATABASE"
echo $quiz_query_cmd

table_name=user

# Create User table
create_table_query="CREATE TABLE IF NOT EXISTS $table_name (id INT AUTO_INCREMENT PRIMARY KEY, uuid VARCHAR(22), name VARCHAR(40),email VARCHAR(60),address VARCHAR(50), is_admin BOOLEAN NOT NULL DEFAULT FALSE );"

create_table_cmd="$quiz_query_cmd -e \"$create_table_query\""
 
# Run the MySQL command
eval $create_table_cmd
echo
echo Table $table_name created successfully.............
# ---------------------------------------------------------------------------------------------------
# 
# 
# Create Question Table
table_name=question
create_table_query="CREATE TABLE IF NOT EXISTS $table_name (id INT AUTO_INCREMENT PRIMARY KEY, question_text TEXT NOT NULL, option_a VARCHAR(255) NOT NULL, option_b VARCHAR(255) NOT NULL, option_c VARCHAR(255) NOT NULL, option_d VARCHAR(255) NOT NULL, correct_option VARCHAR(1) NOT NULL );"

create_table_cmd="$quiz_query_cmd -e \"$create_table_query\""
 
# Run the MySQL command
eval $create_table_cmd
echo
echo Table $table_name created successfully.............

# ------------------------------------------------------------------------------------------------------------------
# 
# 
# REM Create asked question table
# set table_name=asked_question
# set create_table_query="CREATE TABLE IF NOT EXISTS %table_name% (id INT AUTO_INCREMENT PRIMARY KEY, submitted_ans varchar(1), score INT);"
# set create_table_cmd=%quiz_query_cmd% -e %create_table_query%
# 
# :: Run the MySQL command
# %create_table_cmd%
# echo Table %table_name% created successfully.............
# REM ------------------------------------------------------------------------------------------------------------------
# 
# 
# REM Create quiz table
# set table_name=quiz
# set create_table_query="CREATE TABLE IF NOT EXISTS %table_name% (id INT AUTO_INCREMENT PRIMARY KEY, user_id INT, score INT, created_on DATETIME, FOREIGN KEY (user_id) REFERENCES user(id) );"
# 
# set create_table_cmd=%quiz_query_cmd% -e %create_table_query%
# 
# :: Run the MySQL command
# %create_table_cmd%
# echo Table %table_name% created successfully.............
# REM ------------------------------------------------------------------------------------------------------------------



