<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'content' => "Welcome to our Magazine Store - your premier destination for quality educational and professional magazines.

Founded with a passion for knowledge and learning, we have been serving students, professionals, and educational institutions with carefully curated magazines and publications.

Our Mission:
To make quality educational content accessible to everyone by providing a comprehensive collection of magazines covering various subjects including competitive exams, professional development, current affairs, and educational resources.

What We Offer:
• Comprehensive magazine collection for various competitive exams
• Digital and print format options
• Regular updates with latest content
• User-friendly platform for easy browsing and purchasing
• Secure payment processing
• Instant digital downloads

Our Commitment:
We are committed to providing our customers with:
- High-quality content from trusted publishers
- Affordable pricing for students and professionals
- Excellent customer service and support
- Regular updates and new additions to our catalog
- Secure and reliable platform for all transactions

Whether you're preparing for competitive exams, staying updated with current affairs, or looking for professional development resources, we have something for everyone.

Thank you for choosing us as your trusted source for educational magazines and publications.",
                'meta_title' => 'About Us - Magazine Store',
                'meta_description' => 'Learn about our mission to provide quality educational magazines and publications for students and professionals.',
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact-us',
                'content' => "Get in touch with us - we're here to help!

We value your feedback and are always ready to assist you with any questions or concerns about our services.

Contact Information:

Email Support:
• General Inquiries: info@magazinestore.com
• Customer Support: support@magazinestore.com
• Technical Issues: tech@magazinestore.com
• Business Partnerships: business@magazinestore.com

Phone Support:
• Customer Service: +91-XXXX-XXXX-XX
• Technical Support: +91-XXXX-XXXX-XX
Available: Monday to Friday, 9:00 AM to 6:00 PM IST

Office Address:
Magazine Store Pvt. Ltd.
123 Education Street
Knowledge City, State - 123456
India

Business Hours:
Monday to Friday: 9:00 AM - 6:00 PM
Saturday: 10:00 AM - 4:00 PM
Sunday: Closed

For quick assistance, you can also use the contact form below. We aim to respond to all inquiries within 24 hours.

Frequently Asked Questions:
Before contacting us, you might find answers to common questions in our FAQ section. This can help you get immediate assistance for common issues.

Follow Us:
Stay connected with us on social media for updates, new releases, and educational content:
• Facebook: @MagazineStore
• Twitter: @MagazineStore
• LinkedIn: Magazine Store
• Instagram: @magazine_store

We appreciate your interest in our services and look forward to hearing from you!",
                'meta_title' => 'Contact Us - Magazine Store',
                'meta_description' => 'Contact Magazine Store for customer support, technical assistance, or general inquiries. We are here to help!',
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'content' => "Privacy Policy

Last updated: " . date('F d, Y') . "

At Magazine Store, we take your privacy seriously. This Privacy Policy explains how we collect, use, and protect your personal information when you use our website and services.

1. Information We Collect

Personal Information:
• Name and contact information
• Email address and phone number
• Billing and shipping addresses
• Payment information (processed securely)
• Account credentials

Usage Information:
• Pages visited and time spent on our website
• Download history and preferences
• Device information and IP address
• Browser type and operating system

2. How We Use Your Information

We use your information to:
• Process orders and payments
• Deliver digital and physical products
• Provide customer support
• Send order confirmations and updates
• Improve our website and services
• Comply with legal obligations

3. Information Sharing

We do not sell or rent your personal information to third parties. We may share information with:
• Payment processors for transaction processing
• Shipping partners for order delivery
• Legal authorities when required by law
• Service providers who assist in our operations

4. Data Security

We implement appropriate security measures to protect your information:
• Encryption of sensitive data
• Secure payment processing
• Regular security audits
• Access controls and authentication
• Data backup and recovery procedures

5. Your Rights

You have the right to:
• Access your personal information
• Update or correct your data
• Delete your account and data
• Opt-out of marketing communications
• Request data portability

6. Cookies and Tracking

We use cookies to:
• Remember your preferences
• Analyze website usage
• Provide personalized content
• Improve user experience

You can control cookie settings through your browser preferences.

7. Data Retention

We retain your information for as long as necessary to:
• Provide our services
• Comply with legal obligations
• Resolve disputes
• Enforce our agreements

8. Children's Privacy

Our services are not intended for children under 13. We do not knowingly collect personal information from children under 13.

9. Changes to This Policy

We may update this Privacy Policy periodically. We will notify you of significant changes via email or website notice.

10. Contact Us

If you have questions about this Privacy Policy, please contact us at:
Email: privacy@magazinestore.com
Address: 123 Education Street, Knowledge City, State - 123456

By using our services, you agree to the collection and use of information in accordance with this Privacy Policy.",
                'meta_title' => 'Privacy Policy - Magazine Store',
                'meta_description' => 'Read our Privacy Policy to understand how we collect, use, and protect your personal information.',
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Terms and Conditions',
                'slug' => 'terms-and-conditions',
                'content' => "Terms and Conditions

Last updated: " . date('F d, Y') . "

Welcome to Magazine Store. These Terms and Conditions govern your use of our website and services.

1. Acceptance of Terms

By accessing and using our website, you accept and agree to be bound by the terms and provision of this agreement.

2. Use License

Permission is granted to temporarily download materials on Magazine Store's website for personal, non-commercial transitory viewing only.

Under this license you may not:
• Modify or copy the materials
• Use the materials for commercial purposes
• Attempt to reverse engineer any software
• Remove copyright or proprietary notations

3. Account Terms

You are responsible for:
• Maintaining account security
• All activities under your account
• Providing accurate information
• Notifying us of unauthorized use

4. Products and Services

Digital Products:
• Digital magazines are delivered electronically
• Downloads are available immediately after payment
• Multiple download attempts may be limited
• Products are for personal use only

Physical Products:
• Shipping times vary by location
• We are not responsible for shipping delays
• Products must be in original condition for returns

5. Payment Terms

• All prices are in Indian Rupees (INR)
• Payment is due immediately upon order
• We accept major credit cards and digital payments
• All sales are final unless otherwise specified

6. Intellectual Property

All content, trademarks, and data on this website are the property of Magazine Store or content suppliers. You may not use our intellectual property without written permission.

7. User Conduct

You agree not to:
• Violate any applicable laws or regulations
• Share account credentials with others
• Upload malicious code or content
• Interfere with website operations
• Engage in fraudulent activities

8. Disclaimers

• Services are provided 'as is' and 'as available'
• We do not guarantee uninterrupted service
• We are not liable for third-party content
• Educational content is for informational purposes

9. Limitation of Liability

Magazine Store shall not be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use of our services.

10. Refund Policy

Digital Products:
• Refunds may be provided within 7 days of purchase
• Must be due to technical issues preventing access
• Proof of technical problem may be required

Physical Products:
• Returns accepted within 15 days of delivery
• Products must be in original condition
• Customer responsible for return shipping

11. Privacy

Your privacy is important to us. Please review our Privacy Policy, which also governs your use of our services.

12. Termination

We may terminate or suspend your account immediately, without prior notice, for conduct that we believe violates these Terms.

13. Governing Law

These Terms shall be governed and construed in accordance with the laws of India, without regard to its conflict of law provisions.

14. Changes to Terms

We reserve the right to modify these terms at any time. We will notify users of significant changes.

15. Contact Information

If you have any questions about these Terms and Conditions, please contact us at:
Email: legal@magazinestore.com
Address: 123 Education Street, Knowledge City, State - 123456

By using our services, you signify your acceptance of these Terms and Conditions.",
                'meta_title' => 'Terms and Conditions - Magazine Store',
                'meta_description' => 'Read our Terms and Conditions to understand the rules and regulations for using our services.',
                'is_published' => true,
                'sort_order' => 4,
            ],
        ];

        foreach ($pages as $pageData) {
            Page::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );
        }

        $this->command->info('Default pages created successfully!');
    }
}
