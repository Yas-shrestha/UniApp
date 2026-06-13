<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'category_name' => 'Artificial Intelligence',
                'title' => 'The Future of AI in Enterprise Workflows',
                'author' => 'Dr. Sarah Jenkins',
                'published_at' => now()->subDays(2),
                'excerpt' => 'Explore how enterprise organizations are integrating large language models to automate internal operations and improve productivity.',
                'body' => 'Enterprise workflows are shifting rapidly with the rise of generative AI. Rather than replacing workers, AI-driven automation is augmenting human capacity by taking over repetitive tasks like document parsing, first-level customer service, and data analysis. In this guide, we dive deep into how forward-thinking enterprises are deploying private LLMs to protect sensitive data while reaping the rewards of modern intelligence systems.',
                'image' => 'types-1.png',
                'quick_links' => [
                    ['label' => 'AI Guides', 'url' => '#'],
                    ['label' => 'Enterprise Solutions', 'url' => '#'],
                ],
                'is_featured' => true,
            ],
            [
                'category_name' => 'Future of Work',
                'title' => 'How Remote Teams Leverage Collaboration Automation',
                'author' => 'Marcus Vance',
                'published_at' => now()->subDays(5),
                'excerpt' => 'Discover the tools and habits that keep hybrid and remote teams aligned in an increasingly digital and fast-paced world.',
                'body' => 'As organizations transition to hybrid or fully remote structures, maintaining team alignment becomes a crucial challenge. Collaboration automation bridges this gap by automatically updating project boards, scheduling check-ins, and summarizing long meetings. By integrating these systems, teams can spend less time in administrative meetings and more time on high-impact work.',
                'image' => 'types-2.png',
                'quick_links' => [
                    ['label' => 'Remote Toolkit', 'url' => '#'],
                ],
                'is_featured' => false,
            ],
            [
                'category_name' => 'Machine Learning',
                'title' => 'Deep Dive: Modern Machine Learning Architectures',
                'author' => 'Elena Rostova',
                'published_at' => now()->subDays(10),
                'excerpt' => 'An in-depth look at transformers, diffusion models, and the architectures powering the latest AI breakthroughs.',
                'body' => 'Under the hood of today\'s flashy AI applications lies a sophisticated network of machine learning architectures. While the transformer model continues to dominate natural language processing, diffusion models have revolutionized computer vision. In this technical deep dive, we examine the mathematical foundations of these models and how they are trained on massive datasets.',
                'image' => 'types-3.png',
                'quick_links' => [
                    ['label' => 'Research Paper', 'url' => '#'],
                    ['label' => 'Code Implementation', 'url' => '#'],
                ],
                'is_featured' => false,
            ],
            [
                'category_name' => 'Data & Analytics',
                'title' => 'Unlocking Value from Big Data: Actionable Strategies',
                'author' => 'Rajesh Kumar',
                'published_at' => now()->subDays(12),
                'excerpt' => 'Learn how modern companies turn raw telemetry data into strategic insights that drive business decisions.',
                'body' => 'Data is often called the new oil, but raw data is useless without the refining process. Business intelligence platforms and data warehouses allow teams to aggregate telemetry from multiple channels. By using advanced analytics and visualization techniques, key stakeholders can identify market trends, customer behavior, and system bottlenecks before they impact the bottom line.',
                'image' => 'types-4.png',
                'quick_links' => [
                    ['label' => 'Analytics Solutions', 'url' => '#'],
                ],
                'is_featured' => false,
            ],
            [
                'category_name' => 'Automation',
                'title' => 'Automating the Mundane: A Guide to Business Workflows',
                'author' => 'Chloe Dupont',
                'published_at' => now()->subDays(15),
                'excerpt' => 'Identify high-friction processes in your day-to-day work and learn how to automate them using simple API integrations.',
                'body' => 'Every business has repetitive processes that consume valuable time—whether it is copy-pasting customer details across sheets or manually generating invoices. Workflow automation allows these steps to occur seamlessly in the background. In this post, we map out standard low-hanging fruit for automation and showcase how simple API integrations can save your team hours of work weekly.',
                'image' => 'types-5.png',
                'quick_links' => [
                    ['label' => 'Workflow Examples', 'url' => '#'],
                ],
                'is_featured' => false,
            ],
        ];

        foreach ($blogs as $b) {
            $category = Category::where('name', $b['category_name'])->first();

            Blog::create([
                'category_id' => $category ? $category->id : null,
                'title' => $b['title'],
                'slug' => Str::slug($b['title']),
                'author' => $b['author'],
                'published_at' => $b['published_at'],
                'excerpt' => $b['excerpt'],
                'body' => $b['body'],
                'image' => $b['image'],
                'quick_links' => $b['quick_links'],
                'is_featured' => $b['is_featured'],
            ]);
        }
    }
}
