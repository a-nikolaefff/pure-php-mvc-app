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
values ('Noah Johnson', 'confident-noah@example.com',
        'Create a mobile app that helps users track their daily water intake.', true,
        '2023-01-05 06:35:01+03'),
       ('Ethan Smith', 'empathetic-ethan@example.com',
        'Develop an e-commerce website that allows customers to browse products and make purchases.', true,
        '2023-01-09 14:52:42+03'),
       ('Charlotte Williams', 'charismatic-charlotte@example.com',
        'Build a website that displays live weather data for a given location.',
        true, '2023-01-15 09:30:12+03'),
       ('Amelia Brown', 'ambitious-amelia@example.com',
        'Develop a machine learning model to predict customer churn for a subscription-based service.', true,
        '2023-01-17 11:17:38+03'),
       ('Abigail Davis', 'courageous-abigail@example.com',
        'Write a program that converts a decimal number to a binary representation.',
        false, '2023-01-19 08:41:59+03'),
       ('Lucas Garcia', 'creative-lucas@example.com',
        'Create a mobile app that helps users find local events and activities.', false,
        '2023-01-23 16:10:30+03'),
       ('Harper Wilson', 'diligent-harper@example.com',
        'Implement a function that calculates the factorial of a given number.', false,
        '2023-01-24 11:25:26+03'),
       ('Mia Anderson', 'beautiful-mia@example.com', 'Write a program that simulates a game of tic-tac-toe.', false,
        '2023-01-24 17:59:41+03'),
       ('Alex Taylor', 'honest-alex@example.com',
        'Write a program that converts temperature from Celsius to Fahrenheit.', false,
        '2023-01-27 10:11:19+03'),
       ('Isabella Martin', 'independent-isabella@example.com',
        'Implement a search algorithm to find the shortest path between two points on a graph.', false,
        '2023-01-28 15:49:52+03'),
       ('Max Lee', 'mad-max@example.com',
        'Create a web application that allows users to register, login, and submit blog posts.', false,
        '2023-02-06 12:05:11+03'),
       ('Emily Clark', 'kind-emily@example.com',
        'Implement a function that sorts a list of numbers using the bubble sort algorithm.', false,
        '2023-02-07 11:34:28+03'),
       ('Elijah Robinson', 'elijah@example.com',
        'Develop an online learning platform that allows teachers to create and manage courses.', false,
        '2023-02-07 16:03:45+03'),
       ('Sophia Wright', 'optimistic-sophia@example.com',
        'Implement a function that returns the sum of two numbers entered by the user.',
        false, '2023-02-09 09:07:37+03'),
       ('Ava Lopez', 'passionate-ava@example.com',
        'Build a chatbot that can answer user questions about a specific topic.', false,
        '2023-02-09 11:52:01+03'),
       ('Liam Scott', 'super-liam@example.com', 'Design a database schema for a social media platform.', false,
        '2023-02-09 14:30:56+03'),
       ('Ella Young', 'real-ella@example.com',
        'Design a REST API that allows users to upload and download files to a cloud storage service.', false,
        '2023-02-10 10:36:44+03'),
       ('Benjamin Allen', 'angry-benjamin@example.com',
        'Build a web app that allows users to create and share to-do lists.', false,
        '2023-02-10 15:10:05+03'),
       ('William King', 'evil-william@example.com', 'Write a program that generates a random password for a user.',
        false,
        '2023-02-11 09:44:15+03'),
       ('James Baker', 'just-james@example.com',
        'Create a web-based quiz game that allows users to compete against each other.',
        false, '2023-02-11 14:05:23+03'),
       ('John Smith', 'black-john@example.com', 'Implement a sorting algorithm in PHP',
        false, '2023-02-12 09:23:15+03'),
       ('Jane Doe', 'cute-jane@example.com', 'Develop a responsive web page using HTML, CSS, and JavaScript',
        false, '2023-02-12 10:05:39+03'),
       ('Alex Johnson', 'magical-alex@example.com', 'Build a RESTful API in Node.js',
        false, '2023-02-13 08:01:55+03'),
       ('Emily Brown', 'amazing-emily@example.com', ' Create a machine learning model using Python',
        false, '2023-02-13 17:45:20+03'),
       ('Michael Lee', 'incredible-michael@example.com', 'Write a program in C++ to solve a mathematical problem',
        false, '2023-02-14 10:17:36+03'),
       ('Sarah Thompson', 'sthompson@example.com', 'Design a database schema for an e-commerce website',
        false, '2023-02-14 12:40:10+03'),
       ('David Wilson', 'dwilson@example.com', 'Develop a mobile app for iOS using Swift',
        false, '2023-02-15 11:58:17+03'),
       ('Samantha Davis', 'sdavis@example.com', 'Implement a data visualization tool using D3.js',
        false, '2023-02-15 16:32:54+03'),
       ('Kevin Nguyen', 'knguyen@example.com', 'Build a chatbot in Python using natural language processing',
        false, '2023-02-16 10:11:35+03'),
       ('Rachel Hernandez', 'rhernandez@example.com', 'Develop a web application using Ruby on Rails',
        false, '2023-02-16 14:45:21+03'),
       ('Jason Patel', 'jpatel@example.com', 'Create a game in Unity using C#',
        false, '2023-02-17 08:11:49+03'),
       ('Lauren Kim', 'kim@example.com', 'Implement a neural network using TensorFlow',
        false, '2023-02-17 13:27:15+03'),
       ('Andrew Jackson', 'ajackson@example.com', 'Write a program in Java to simulate a network protocol',
        false, '2023-02-18 19:07:26+03'),
       ('Kimberly Baker', 'kbaker@example.com', 'Develop a web scraping tool in Python',
        false, '2023-02-18 21:17:30+03'),
       ('Eric Chen', 'echen@example.com', 'Build a blockchain using Solidity',
        false, '2023-02-19 10:09:05+03'),
       ('Maria Rodriguez', 'mrodriguez@example.com',
        'Design and implement a user authentication system for a web application',
        false, '2023-02-19 14:51:12+03'),
       ('William Martinez', 'wmartinez@example.com', 'Develop a cross-platform desktop application using Electron',
        false, '2023-02-20 09:30:19+03'),
       ('Jessica Garcia', 'jgarcia@example.com', 'Write a program in Python to solve a cryptography problem',
        false, '2023-02-20 12:02:51+03'),
       ('Christopher Wright', 'cwright@example.com', 'Create a website using React.js and Redux',
        false, '2023-02-21 13:24:46+03'),
       ('Elizabeth Taylor', 'etaylor@example.com',
        'Build a recommendation system using collaborative filtering in Python',
        false, '2023-02-24 09:10:11+03'),
       ('Daniel Johnson', 'djohnson@example.com', 'Write a program in C to implement a binary search algorithm',
        false, '2023-02-25 16:57:02+03'),
       ('Christina Kim', 'awilson@example.com', 'Design a user interface for a mobile app using Sketch',
        false, '2023-02-26 15:42:08+03'),
       ('Benjamin Thompson', 'bthompson@example.com',
        'Write a program in Python to automate web testing using Selenium',
        false, '2023-02-28 12:47:09+03'),
       ('Abigail Martinez', 'amartinez@example.com',
        'Build a recommendation system using content-based filtering in Python',
        false, '2023-03-01 10:39:16+03'),
       ('Ava Wilson', 'mjones@example.com', 'Write a program in Python to perform sentiment analysis on text data',
        false, '2023-03-02 14:27:47+03'),
       ('Matthew Jones', 'mjones@example.com', 'Create a game in Unreal Engine using C++',
        false, '2023-03-03 11:17:56+03'),
       ('Mia Thompson', 'mthompson@example.com', 'Create a web-based project management tool using Ruby on Rails',
        false, '2023-03-04 13:37:21+03'),
       ('Olivia Davis', 'modavis@example.com', 'Implement a natural language processing algorithm in Java',
        false, '2023-03-05 09:53:23+03'),
       ('William Jackson', 'wjackson@example.com',
        'Develop a machine learning algorithm in R to predict customer churn',
        false, '2023-03-06 11:51:05+03'),
       ('Ethan Brown', 'ebrown@example.com', 'Develop a RESTful API in Java using Spring Boot',
        false, '2023-03-07 08:19:51+03'),
       ('Emily Hernandez', 'ehernandez@example.com', 'Create a neural network model using Keras',
        false, '2023-03-08 17:24:14+03'),
       ('Ethan Miller', 'emiller@example.com', 'Develop a computer vision system using OpenCV',
        false, '2023-03-09 16:38:12+03'),
       ('James Brown', 'jbrown@example.com', 'Design and implement a relational database using SQL',
        false, '2023-03-10 08:12:31+03'),
       ('Lucas Wilson', 'lwilson@example.com ', 'Develop a mobile game using Unity and C#',
        false, '2023-03-11 14:08:43+03'),
       ('Timothy Nguyen', 'tnguyen@example.com', 'Build a web crawler in Python to extract data from websites',
        false, '2023-03-12 10:21:34+03'),
       ('William Garcia', 'wgarica@example.com ',
        'Build a mobile app in React Native for both Android and iOS platforms',
        false, '2023-03-12 19:05:54+03'),
       ('Chloe Smith', 'csmith@example.com', 'Design and implement an API using GraphQL',
        false, '2023-03-13 09:56:22+03'),
       ('Isabella Davis', 'idavis@example.com',
        'Implement a time series analysis model in Python using pandas and numpy',
        false, '2023-03-14 10:03:39+03'),
       ('Sophia Lee', 'slee@example.com', 'Build a web application using Flask and MongoDB',
        false, '2023-03-15 13:09:27+03');





