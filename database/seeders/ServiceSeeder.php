<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'type' => 'traditional',
                'title' => 'Custom Software Development',
                'short_description' => 'Design and develop tailor-made software solutions that align with your unique business goals and workflows.',
                'body' => 'In today\'s digital landscape, generic off-the-shelf software often falls short of meeting specific organizational needs. Our custom software development service provides end-to-end consulting, design, and deployment of custom-built applications. Whether you need a secure enterprise dashboard, a customer portal, or a scalable mobile app, our team of seasoned engineers uses modern technologies to deliver robust, reliable, and secure systems.',
                'icon' => 'bi bi-laptop',
                'points' => [
                    'Enterprise dashboard development',
                    'Secure RESTful API design',
                    'Cloud deployment & scaling',
                    'Database design and optimization',
                ],
                'is_featured' => true,
            ],
            [
                'type' => 'traditional',
                'title' => 'Cloud Infrastructure & Support',
                'short_description' => 'Maintain peak performance and security with our comprehensive cloud migration and maintenance services.',
                'body' => 'Migrating to the cloud and maintaining infrastructure can be complex. We simplify this process by offering expert cloud support, setting up robust CI/CD pipelines, configuring auto-scaling, and monitoring performance. Our teams ensure your cloud environment is secure, compliant, and cost-effective, using platforms like AWS, Google Cloud, and Microsoft Azure.',
                'icon' => 'bi bi-cloud-arrow-up',
                'points' => [
                    'AWS and GCP migration',
                    'Continuous Integration & Deployment (CI/CD)',
                    'Automated backups and disaster recovery',
                    '24/7 infrastructure monitoring',
                ],
                'is_featured' => false,
            ],
            [
                'type' => 'future',
                'title' => 'Predictive Data Analytics',
                'short_description' => 'Leverage historical data to forecast future trends and make proactive business decisions with confidence.',
                'body' => 'Data analytics is no longer just about looking at the past. Our predictive analytics service builds advanced machine learning models that analyze historical patterns to forecast sales, customer behavior, and resource demands. By translating raw data into predictive metrics, we empower your business to stay ahead of the competition and make data-informed strategic choices.',
                'icon' => 'bi bi-bar-chart-line',
                'points' => [
                    'Regression and time-series forecasting',
                    'Customer churn prediction models',
                    'Real-time data stream analytics',
                    'Interactive dashboard integrations',
                ],
                'is_featured' => false,
            ],
            [
                'type' => 'future',
                'title' => 'Cognitive Search & Chatbots',
                'short_description' => 'Deploy conversational AI and intelligent search systems to retrieve documents and resolve user inquiries instantly.',
                'body' => 'Cognitive Search & Chatbots represent the vanguard of customer and employee support. By using state-of-the-art NLP models, our systems understand semantic search queries and provide precise answers from your unstructured knowledge base. Our conversational AI integration handles support tickets, schedules bookings, and automates common queries, reducing support team load by up to 60%.',
                'icon' => 'bi bi-chat-left-text',
                'points' => [
                    'NLP-driven cognitive search engines',
                    'Multi-lingual conversational AI chatbots',
                    'Knowledge base semantic indexing',
                    'Seamless CRM and Slack integrations',
                ],
                'is_featured' => true,
            ],
        ];

        foreach ($services as $s) {
            Service::create([
                'type' => $s['type'],
                'title' => $s['title'],
                'slug' => Str::slug($s['title']),
                'short_description' => $s['short_description'],
                'body' => $s['body'],
                'icon' => $s['icon'],
                'points' => $s['points'],
                'is_featured' => $s['is_featured'],
            ]);
        }
    }
}
