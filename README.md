# Fake Blog API

Welcome to the Free Fake Blog API documentation! This API has been developed by Programmers City using PHP to provide a seamless and efficient way for developers to interact with blog data programmatically. Whether you're building a content management system, a blogging platform, or integrating blog functionalities into an existing application, the Fake Blog API offers a robust and flexible solution to meet your needs.

## Overview

The Fake Blog API is a **free api solution** that allows you to perform various operations related to blog posts, authors, comments, and categories. It is designed to be easy to use and integrate, with a RESTful architecture that adheres to standard HTTP methods. The API supports a wide range of functionalities, including:

- **Creating, reading, updating, and deleting blog posts**
- **Managing authors and their profiles**
- **Handling comments on blog posts**
- **Categorizing blog posts**

## Key Features

- **RESTful Design**: The API uses standard HTTP methods and status codes, making it intuitive for developers to use and understand.
- **JSON Responses**: All responses are formatted in JSON, ensuring compatibility with a wide range of programming languages and frameworks.
- **Authentication**: Secure access to the API is ensured through token-based authentication, protecting your data and operations.
<!-- - **Pagination and Filtering**: Efficiently handle large datasets with built-in support for pagination and filtering. -->
- **Extensive Documentation**: Comprehensive documentation with examples for every endpoint, making it easy to get started and integrate the API.


## Getting Started (Usage)
To start using the Fake Blog API, you'll need to first consider the method of usage as the project can be used by cloning a copy of it to your local environment or by using the official programmers city fake blog base URL.
  
### Cloning a copy of the project

You can clone the project into your local machine from this repository:
```
https://github.com/destinybravos/fake_blog_api.git
```

Make sure you have a PHP Web-Solution stack (Local Server) installed in you local machine as the project needs the **Apache** and **MySQL** services to run. A very good example is the **XAMPP Server** in which you have to clone the project into the `htdocs` folder, then you can access it with the base url `http://localhost/fake_blog_api`.

### Example Request
#### Fetch Categories
Here is a simple example of how to fetch all categories:

```sh
curl -X POST "http://localhost/fake_blog_api/v1/category/fetch.php" 
```

#### Fetch Users
Here is a simple example of how to fetch all users:

```sh
curl -X POST "http://localhost/fake_blog_api/v1/users/fetch.php" 
```

#### Fetch Posts
Here is a simple example of how to fetch all categories:

```sh
curl -X POST "http://localhost/fake_blog_api/v1/posts/fetch_all.php" 
```

#### Fetch A Post with Details
Here is a simple example of how to fetch all categories:

```sh
curl -X POST "http://localhost/fake_blog_api/v1/posts/fetch_details.php?post_id={id}" 
```



### Example Response

```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "title": "First Blog Post",
      "content": "This is the content of the first blog post.",
      "author_id": 1,
      "category_id": 2,
      "created_at": "2024-01-01T12:00:00Z",
      "updated_at": "2024-01-01T12:00:00Z"
    },
    ...
  ]
}
```

### Official Base URL

If you are using the official version on our platform, Kindly note that all API requests are made to the following base URL:
```
https://api.programmerscity.com/v1/fakeblog
```


### Example Request

Here is a simple example of how to fetch all blog posts:

```sh
curl -X GET "https://api.programmerscity.com/v1/fakeblog/posts" \
     -H "Authorization: Bearer YOUR_API_KEY"
```

### Example Response

```json
{
  "status": "success",
  "data": [
    {
      "id": 1,
      "title": "First Blog Post",
      "content": "This is the content of the first blog post.",
      "author_id": 1,
      "category_id": 2,
      "created_at": "2024-01-01T12:00:00Z",
      "updated_at": "2024-01-01T12:00:00Z"
    },
    ...
  ]
}
```

## Documentation Structure

- **Authentication**: Detailed information on how to authenticate your requests.
- **Endpoints**: Descriptions and examples for all available endpoints.
  - **Posts**: CRUD operations for blog posts.
  - **Authors**: Managing authors and their profiles.
  - **Comments**: Handling comments on posts.
  - **Categories**: Categorizing blog posts.
  - **Analytics**: Fetching blog activity statistics.
- **Error Handling**: Common error codes and their meanings.
- **Best Practices**: Tips for efficient and secure API usage.
- **FAQs**: Answers to frequently asked questions.

We hope this documentation helps you make the most of the Fake Blog API. If you have any questions or need further assistance, please contact our support team at support@programmerscity.com.

Happy coding!

The Programmers City Team