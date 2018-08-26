<?php

use Illuminate\Database\Seeder;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('applications')->insert([
            'name' => 'Web Goat',
            'path' => '/WebGoat',
            'link_docs' => 'https://github.com/WebGoat/WebGoat',
            'description' => 'WebGoat is a deliberately insecure web application designed to teach web application security lessons.',
            'author' => 'OWASP',
            'link_author' => 'https://www.owasp.org',
            'stackscript' => 331713,
            'label' => 'webgoat'
        ]);

        DB::table('applications')->insert([
            'name' => 'Damn Vulnerable Web App',
            'path' => '/WebGoat',
            'link_docs' => 'https://github.com/ethicalhack3r/DVWA',
            'description' => 'Damn Vulnerable Web App (DVWA) is a PHP/MySQL web application that is damn vulnerable. Its main goals are to be an aid for security professionals to test their skills and tools in a legal environment, help web developers better understand the processes of securing web applications and aid teachers/students to teach/learn web application security in a class room environment.',
            'author' => 'Dewhurst Security',
            'link_author' => 'https://dewhurstsecurity.com/',
            'stackscript' => 334281,
            'label' => 'dvwa'
        ]);


    }
}
