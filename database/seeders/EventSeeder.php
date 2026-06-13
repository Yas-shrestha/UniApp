<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'category_name' => 'Artificial Intelligence',
                'title' => 'Generative AI Workshop: Building with LLMs',
                'image' => 'types-1.png',
                'date' => now()->addDays(5),
                'time' => '09:00 AM – 01:00 PM',
                'location' => 'Silicon Valley Innovation Center & Virtual',
                'seats' => '35 seats left',
                'admission' => 'Free for registered attendees',
                'intro' => 'A hands-on workshop focused on building and deploying applications powered by large language models. Learn best practices for prompt engineering, retrieval-augmented generation (RAG), and fine-tuning.',
                'points' => [
                    'Understand transformer architectures and prompt design',
                    'Implement Retrieval-Augmented Generation (RAG) pipelines',
                    'Evaluate and test LLM outputs for reliability',
                    'Deploy model endpoints securely in cloud environments',
                ],
                'audience' => 'Software engineers, data scientists, and technical product managers looking to integrate LLM technology into their stack.',
                'speaker_name' => 'Dr. Alan Mercer',
                'speaker_role' => 'Head of AI Research at Grandview',
                'speaker_image' => 'avatar-1.webp',
            ],
            [
                'category_name' => 'Future of Work',
                'title' => 'The Future of Remote Work & Automation Summit',
                'image' => 'types-2.png',
                'date' => now()->addDays(12),
                'time' => '10:00 AM – 04:00 PM',
                'location' => 'Grandview Conference Hall (New York)',
                'seats' => 'Limited seating available',
                'admission' => '$99 General Admission / Free for Students',
                'intro' => 'Join industry leaders and automation experts as we discuss the evolving landscape of hybrid work, asynchronous communication tools, and the role of autonomous agents in daily operations.',
                'points' => [
                    'Design collaborative workflows for decentralized teams',
                    'Assess the impact of AI agents on administrative tasks',
                    'Build an automated business operations pipeline',
                    'Hear success stories from leading fully remote enterprises',
                ],
                'audience' => 'Operations managers, HR leaders, startup founders, and anyone interested in modern organizational design.',
                'speaker_name' => 'Sarah Jenkins',
                'speaker_role' => 'Director of Workplace Experience',
                'speaker_image' => 'avatar-2.webp',
            ],
            [
                'category_name' => 'Machine Learning',
                'title' => 'Practical Machine Learning for Data Analytics',
                'image' => 'types-3.png',
                'date' => now()->addDays(20),
                'time' => '02:00 PM – 05:00 PM',
                'location' => 'Online Webinar',
                'seats' => 'Unlimited Virtual Seats',
                'admission' => 'Free Registration Required',
                'intro' => 'Unlock the power of machine learning algorithms to uncover hidden patterns in your data. This webinar covers classification, regression, and clustering algorithms with hands-on Python examples.',
                'points' => [
                    'Prepare and clean structured datasets for modeling',
                    'Train and evaluate Scikit-Learn models',
                    'Interpret model coefficients and feature importance',
                    'Integrate predictions into existing dashboard reports',
                ],
                'audience' => 'Data analysts, business analysts, and developers looking to transition into machine learning.',
                'speaker_name' => 'Rajesh Kumar',
                'speaker_role' => 'Lead Data Architect',
                'speaker_image' => 'avatar-3.webp',
            ],
            [
                'category_name' => 'Automation',
                'title' => 'Workflow Automation Masterclass: Zapier & Make',
                'image' => 'types-5.png',
                'date' => now()->addDays(25),
                'time' => '01:00 PM – 03:00 PM',
                'location' => 'Virtual Classroom',
                'seats' => '15 seats left',
                'admission' => '$49 Ticket',
                'intro' => 'Transform how you handle daily operations. In this masterclass, we teach you how to build automated triggers, manage multi-step data flows, and connect disparate SaaS tools without writing a single line of code.',
                'points' => [
                    'Design complex multi-step automation logic',
                    'Configure error handling and data formatting steps',
                    'Use webhooks and custom API requests in Zapier/Make',
                    'Audit and optimize automated tasks for cost-efficiency',
                ],
                'audience' => 'Small business owners, operations leads, and productivity enthusiasts seeking to streamline manual processes.',
                'speaker_name' => 'Chloe Dupont',
                'speaker_role' => 'Workflow Optimization Consultant',
                'speaker_image' => 'avatar-4.webp',
            ],
        ];

        foreach ($events as $e) {
            $category = Category::where('name', $e['category_name'])->first();

            Event::create([
                'category_id' => $category ? $category->id : null,
                'title' => $e['title'],
                'slug' => Str::slug($e['title']),
                'image' => $e['image'],
                'date' => $e['date'],
                'time' => $e['time'],
                'location' => $e['location'],
                'seats' => $e['seats'],
                'admission' => $e['admission'],
                'intro' => $e['intro'],
                'points' => $e['points'],
                'audience' => $e['audience'],
                'speaker_name' => $e['speaker_name'],
                'speaker_role' => $e['speaker_role'],
                'speaker_image' => $e['speaker_image'],
            ]);
        }
    }
}
