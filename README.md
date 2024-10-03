# Laravel GraphQL API Project

A RESTful API application based on Laravel, fully integrated with GraphQL for efficient querying and managing of data. Laravel Sail is used as a simple development setup via Docker containers. The API supports various CRUD operations for managing entities like Users, Articles, and Categories.

## Features

- **Laravel Framework (v10)**: The foundation of the application.
- **GraphQL API**: Provides a powerful and flexible API using GraphQL.
- **Docker-based Setup**: Uses Laravel Sail for easy environment setup with Docker.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)
- [Usage](#usage)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- **PHP 8.1 or higher**
- **Composer**
- **Docker** and **Docker Compose**
- **Laravel Sail** (included in the project)
- **rebing/graphql-laravel** (GraphQL package for Laravel)

## Installation

Follow these steps to install the application:

1. **Clone the repository**:
    ```bash
    git clone <repository-url>
    cd <project-directory>
    ```

2. **Install the dependencies**:
    ```bash
    ./vendor/bin/sail composer install
    ```

3. **Copy the environment file**:
    ```bash
    cp .env.example .env
    ```

4. **Generate the application key**:
    ```bash
    ./vendor/bin/sail artisan key:generate
    ```

## Rebuilding Sail Images

Sometimes you may want to completely rebuild your Sail images to ensure all of the image's packages and software are up to date. You can accomplish this using the following commands:

1. **Stop and remove all containers and volumes**:
    ```bash
    docker compose down -v
    # or
    ./vendor/bin/sail down
    ```

2. **Rebuild the Sail images**:
    ```bash
    ./vendor/bin/sail build --no-cache
    ```

3. **Start the Sail environment**:
    ```bash
    ./vendor/bin/sail up -d
    ```

## Running the Application

After setting up the Sail environment, proceed with the following steps:

5. **Run the migrations**:
    ```bash
    ./vendor/bin/sail artisan migrate
    ```

6. **Seed the database**:
    ```bash
    ./vendor/bin/sail artisan db:seed --class=DatabaseSeeder
    ```

7. **If needed, refresh the database** (drop all tables, run migrations, and seed again):
    ```bash
    ./vendor/bin/sail artisan migrate:refresh --seed
    ```

8. **Optimize the application**:
    ```bash
    ./vendor/bin/sail artisan optimize
    ```

## Usage

Once the application is running, you can access it at `http://localhost/graphql`. You can perform various operations, including creating, updating, deleting, and searching for articles, users, and categories using the GraphQL API.

To interact with the GraphQL API, you can use tools such as **Postman**.

### Example GraphQL Queries & Mutations 

Here are some example GraphQL queries to interact with the application:

#### Fetch All Articles
```graphql
query {
  articles {
    id
    title
    content
    author {
      name
    }
    category {
      name
    }
  }
}
```

#### Create a New Article
```graphql
mutation {
  createArticle(input: {
    title: "New Article Title",
    content: "Content of the article",
    author_id: 1,
    category_id: 2
  }) {
    id
    title
    content
  }
}
```