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
    null
);

alter table if exists tasks
    owner to postgres;

insert into admins (name, password_hash)
values  ('admin', '$2y$10$nugEnyTqHj7LAa.9hxD2TeOJKoJMk9hOSQbnSa4nVnZDHOmusuHUq');

insert into tasks (user_name, user_email, description, is_done)
values ('Noah', 'noah@example.com', 'Create a mobile app that helps users track their daily water intake.', true),
       ('Ethan', 'ethan@example.com',
        'Develop an e-commerce website that allows customers to browse products and make purchases.', true),
       ('Charlotte', 'charlotte@example.com', 'Build a website that displays live weather data for a given location.',
        false),
       ('Amelia', 'amelia@example.com',
        'Develop a machine learning model to predict customer churn for a subscription-based service.', false),
       ('Abigail', 'abigail@example.com', 'Write a program that converts a decimal number to a binary representation.',
        false),
       ('Lucas', 'lucas@example.com', 'Create a mobile app that helps users find local events and activities.', false),
       ('Harper', 'harper@example.com', 'Implement a function that calculates the factorial of a given number.', false),
       ('Mia', 'mia@example.com', 'Write a program that simulates a game of tic-tac-toe.', false),
       ('Alex', 'alex@example.com', 'Write a program that converts temperature from Celsius to Fahrenheit.', false),
       ('Isabella', 'isabella@example.com',
        'Implement a search algorithm to find the shortest path between two points on a graph.', false),
       ('Max', 'max@example.com',
        'Create a web application that allows users to register, login, and submit blog posts.', false),
       ('Emily', 'emily@example.com',
        'Implement a function that sorts a list of numbers using the bubble sort algorithm.', false),
       ('Elijah', 'elijah@example.com',
        'Develop an online learning platform that allows teachers to create and manage courses.', false),
       ('Sophia', 'sophia@example.com', 'Implement a function that returns the sum of two numbers entered by the user.',
        false),
       ('Ava', 'ava@example.com', 'Build a chatbot that can answer user questions about a specific topic.', false),
       ('Liam', 'liam@example.com', 'Design a database schema for a social media platform.', false),
       ('Ella', 'ella@example.com',
        'Design a REST API that allows users to upload and download files to a cloud storage service.', false),
       ('Benjamin', 'benjamin@example.com', 'Build a web app that allows users to create and share to-do lists.',
        false),
       ('William', 'william@example.com', 'Write a program that generates a random password for a user.', false),
       ('James', 'james@example.com', 'Create a web-based quiz game that allows users to compete against each other.',
        false);



