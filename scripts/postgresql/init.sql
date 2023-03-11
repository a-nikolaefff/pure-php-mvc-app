create table if not exists admins
(
    id
        serial
        primary
            key
        unique,
    name
        text
        not
            null
        unique,
    password_hash
        text
        not
            null
);

alter table if exists admins
    owner to postgres;

create table if not exists public.tasks
(
    id
               serial
        constraint
            cars_pk
            primary
                key
        unique,
    user_name
               text
                                        not
                                            null,
    user_email
               text
                                        not
                                            null,
    description
               text
                                        not
                                            null,
    is_done
               boolean
        default
            false
                                        not
                                            null,
    created_at timestamp with time zone not
                                            null
);

alter table if exists tasks
    owner to postgres;

insert into admins (name, password_hash)
values ('admin', '$2y$10$nugEnyTqHj7LAa.9hxD2TeOJKoJMk9hOSQbnSa4nVnZDHOmusuHUq');

insert into tasks (user_name, user_email, description, is_done, created_at)
values ('Noah', 'noah@example.com', 'Create a mobile app that helps users track their daily water intake.', true,
        '2023-03-01 06:35:01+03'),
       ('Ethan', 'ethan@example.com',
        'Develop an e-commerce website that allows customers to browse products and make purchases.', true,
        '2023-03-01 14:52:42+03'),
       ('Charlotte', 'charlotte@example.com', 'Build a website that displays live weather data for a given location.',
        false, '2023-03-02 09:30:12+03'),
       ('Amelia', 'amelia@example.com',
        'Develop a machine learning model to predict customer churn for a subscription-based service.', true,
        '2023-03-02 11:17:38+03'),
       ('Abigail', 'abigail@example.com', 'Write a program that converts a decimal number to a binary representation.',
        false, '2023-03-03 08:41:59+03'),
       ('Lucas', 'lucas@example.com', 'Create a mobile app that helps users find local events and activities.', false,
        '2023-03-03 16:10:30+03'),
       ('Harper', 'harper@example.com', 'Implement a function that calculates the factorial of a given number.', false,
        '2023-03-04 11:25:26+03'),
       ('Mia', 'mia@example.com', 'Write a program that simulates a game of tic-tac-toe.', false,
        '2023-03-04 17:59:41+03'),
       ('Alex', 'alex@example.com', 'Write a program that converts temperature from Celsius to Fahrenheit.', false,
        '2023-03-05 10:11:19+03'),
       ('Isabella', 'isabella@example.com',
        'Implement a search algorithm to find the shortest path between two points on a graph.', false,
        '2023-03-05 15:49:52+03'),
       ('Max', 'max@example.com',
        'Create a web application that allows users to register, login, and submit blog posts.', false,
        '2023-03-06 12:05:11+03'),
       ('Emily', 'emily@example.com',
        'Implement a function that sorts a list of numbers using the bubble sort algorithm.', false,
        '2023-03-07 11:34:28+03'),
       ('Elijah', 'elijah@example.com',
        'Develop an online learning platform that allows teachers to create and manage courses.', false,
        '2023-03-07 16:03:45+03'),
       ('Sophia', 'sophia@example.com', 'Implement a function that returns the sum of two numbers entered by the user.',
        false, '2023-03-09 09:07:37+03'),
       ('Ava', 'ava@example.com', 'Build a chatbot that can answer user questions about a specific topic.', false,
        '2023-03-09 11:52:01+03'),
       ('Liam', 'liam@example.com', 'Design a database schema for a social media platform.', false,
        '2023-03-09 14:30:56+03'),
       ('Ella', 'ella@example.com',
        'Design a REST API that allows users to upload and download files to a cloud storage service.', false,
        '2023-03-10 10:36:44+03'),
       ('Benjamin', 'benjamin@example.com', 'Build a web app that allows users to create and share to-do lists.', false,
        '2023-03-10 15:10:05+03'),
       ('William', 'william@example.com', 'Write a program that generates a random password for a user.', false,
        '2023-03-11 09:44:15+03'),
       ('James', 'james@example.com', 'Create a web-based quiz game that allows users to compete against each other.',
        false, '2023-03-11 14:05:23+03');



