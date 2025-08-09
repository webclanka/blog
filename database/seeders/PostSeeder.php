<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Getting Started with Laravel 11',
                'content' => 'Laravel is one of the most popular PHP frameworks in the world. This comprehensive guide will walk you through everything you need to know to get started with Laravel 11, from installation to building your first web application.

Laravel provides an elegant syntax and a robust set of features that make web development enjoyable and efficient. With built-in features like Eloquent ORM, Blade templating engine, and Artisan command line tool, Laravel streamlines the development process.

In this tutorial, we will cover:
- Setting up a Laravel development environment
- Understanding MVC architecture in Laravel
- Creating your first routes and controllers
- Working with databases using Eloquent
- Building responsive views with Blade templates

Whether you\'re a beginner or an experienced developer, this guide will help you master Laravel and build amazing web applications.',
                'excerpt' => 'A comprehensive guide to getting started with Laravel 11, covering everything from installation to building your first application.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(10),
                'view_count' => 1250,
            ],
            [
                'title' => 'Advanced PHP Techniques for Modern Development',
                'content' => 'PHP has evolved significantly over the years, and modern PHP development involves many advanced techniques and best practices. This article explores some of the most important concepts every PHP developer should master.

We\'ll dive deep into:
- Object-oriented programming principles in PHP
- Design patterns and their practical applications
- Working with namespaces and autoloading
- Understanding PHP 8+ features like union types and attributes
- Performance optimization techniques
- Testing strategies with PHPUnit

Modern PHP development is not just about writing code that works, but writing code that is maintainable, testable, and follows industry best practices. By the end of this article, you\'ll have a solid understanding of advanced PHP concepts.',
                'excerpt' => 'Explore advanced PHP techniques and best practices for modern web development.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(8),
                'view_count' => 890,
            ],
            [
                'title' => 'Building RESTful APIs with Laravel',
                'content' => 'REST APIs are the backbone of modern web applications. Laravel provides excellent tools for building robust, scalable APIs. This guide covers everything you need to know about API development in Laravel.

Topics covered include:
- API routing and resource controllers
- Request validation and error handling
- Authentication with Laravel Sanctum
- API versioning strategies
- Response formatting and JSON resources
- Rate limiting and throttling
- API documentation with OpenAPI

We\'ll build a complete blog API from scratch, demonstrating real-world scenarios and best practices. By the end, you\'ll be able to create professional-grade APIs that can power web applications, mobile apps, and third-party integrations.',
                'excerpt' => 'Learn how to build robust RESTful APIs using Laravel\'s powerful features and tools.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(15),
                'view_count' => 2100,
            ],
            [
                'title' => 'Database Design Best Practices',
                'content' => 'A well-designed database is crucial for application performance and maintainability. This article covers essential database design principles and best practices.

Key topics include:
- Database normalization and when to denormalize
- Indexing strategies for optimal performance
- Foreign key constraints and referential integrity
- Choosing the right data types
- Handling NULL values effectively
- Database migrations and version control

We\'ll also explore common pitfalls and how to avoid them, ensuring your database can scale with your application\'s growth.',
                'excerpt' => 'Essential database design principles and best practices for scalable applications.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(12),
                'view_count' => 567,
            ],
            [
                'title' => 'Modern JavaScript ES6+ Features',
                'content' => 'JavaScript has evolved tremendously with ES6+ features. This comprehensive guide explores the most useful modern JavaScript features that every developer should know.

We\'ll cover:
- Arrow functions and their benefits
- Destructuring assignment
- Template literals and string interpolation
- Promises and async/await
- Modules and import/export
- Classes and inheritance
- Map, Set, and other new data structures

Understanding these features will make your JavaScript code more concise, readable, and maintainable. We\'ll provide practical examples and use cases for each feature.',
                'excerpt' => 'Master modern JavaScript ES6+ features with practical examples and use cases.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(20),
                'view_count' => 1890,
            ],
            [
                'title' => 'CSS Grid vs Flexbox: When to Use Which',
                'content' => 'CSS Grid and Flexbox are both powerful layout systems, but they serve different purposes. This article helps you understand when to use each one.

CSS Grid is perfect for:
- Two-dimensional layouts
- Complex grid systems
- Overlapping elements
- Creating responsive layouts with minimal media queries

Flexbox excels at:
- One-dimensional layouts
- Centering content
- Distributing space between items
- Creating flexible navigation bars

We\'ll walk through practical examples and provide decision-making guidelines to help you choose the right tool for your layout needs.',
                'excerpt' => 'Understanding the differences between CSS Grid and Flexbox and when to use each.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(7),
                'view_count' => 734,
            ],
            [
                'title' => 'Introduction to Docker for Web Developers',
                'content' => 'Docker has revolutionized how we develop, test, and deploy applications. This beginner-friendly guide introduces Docker concepts specifically for web developers.

What you\'ll learn:
- Docker fundamentals and terminology
- Creating your first Dockerfile
- Working with Docker Compose
- Container orchestration basics
- Best practices for development environments
- Deploying containerized applications

Docker solves the "it works on my machine" problem and makes your development workflow more consistent and predictable.',
                'excerpt' => 'A beginner-friendly introduction to Docker for web developers.',
                'status' => 'draft',
                'published_at' => null,
                'view_count' => 0,
            ],
            [
                'title' => 'Vue.js 3 Composition API Deep Dive',
                'content' => 'Vue.js 3 introduced the Composition API, a new way to organize and reuse code in Vue components. This deep dive explores all aspects of the Composition API.

Topics covered:
- setup() function fundamentals
- Reactive references and reactive objects
- Computed properties and watchers
- Lifecycle hooks in Composition API
- Creating custom composables
- Migrating from Options API

The Composition API provides better TypeScript support and makes it easier to share logic between components. We\'ll build practical examples to demonstrate these concepts.',
                'excerpt' => 'Master Vue.js 3 Composition API with practical examples and best practices.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(5),
                'view_count' => 456,
            ],
            [
                'title' => 'SEO Best Practices for 2024',
                'content' => 'Search Engine Optimization continues to evolve. This comprehensive guide covers the most important SEO best practices for 2024.

Essential SEO elements include:
- On-page optimization techniques
- Technical SEO fundamentals
- Mobile-first indexing considerations
- Core Web Vitals and page speed
- Content optimization strategies
- Link building in 2024

We\'ll also discuss the impact of AI on search and how to adapt your SEO strategy accordingly. Following these practices will help improve your website\'s visibility in search results.',
                'excerpt' => 'Stay up-to-date with the latest SEO best practices and techniques for 2024.',
                'status' => 'published',
                'published_at' => Carbon::now()->subDays(3),
                'view_count' => 923,
            ],
            [
                'title' => 'Testing Laravel Applications with PHPUnit',
                'content' => 'Testing is a crucial part of application development. Laravel provides excellent testing tools built on top of PHPUnit. This guide covers testing strategies for Laravel applications.

We\'ll explore:
- Unit testing vs Feature testing
- Testing HTTP requests and responses
- Database testing with factories and seeders
- Mocking and stubbing dependencies
- Testing authentication and authorization
- Browser testing with Laravel Dusk

Writing comprehensive tests ensures your application works as expected and makes refactoring safer. We\'ll build a complete test suite for a blog application.',
                'excerpt' => 'Comprehensive guide to testing Laravel applications using PHPUnit and Laravel\'s testing tools.',
                'status' => 'draft',
                'published_at' => null,
                'view_count' => 0,
            ],
        ];

        foreach ($posts as $postData) {
            Post::create($postData);
        }

        // Create some additional posts for pagination testing
        for ($i = 11; $i <= 30; $i++) {
            Post::create([
                'title' => "Sample Blog Post #{$i}",
                'content' => "This is the content for sample blog post #{$i}. It contains enough text to demonstrate the blog functionality and test pagination features. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
                'excerpt' => "This is a sample blog post created for testing purposes.",
                'status' => $i % 3 === 0 ? 'draft' : 'published',
                'published_at' => $i % 3 === 0 ? null : Carbon::now()->subDays(rand(1, 30)),
                'view_count' => rand(10, 500),
            ]);
        }
    }
}
