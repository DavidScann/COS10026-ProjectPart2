-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2025 at 03:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `workshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `job_reference` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `street_address` varchar(40) NOT NULL,
  `suburb` varchar(40) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `skill1` tinyint(1) DEFAULT 0,
  `skill2` tinyint(1) DEFAULT 0,
  `skill3` tinyint(1) DEFAULT 0,
  `skill4` tinyint(1) DEFAULT 0,
  `skill5` tinyint(1) DEFAULT 0,
  `skill6` tinyint(1) DEFAULT 0,
  `skill7` tinyint(1) DEFAULT 0,
  `skill8` tinyint(1) DEFAULT 0,
  `skill9` tinyint(1) DEFAULT 0,
  `skill10` tinyint(1) DEFAULT 0,
  `skill11` tinyint(1) DEFAULT 0,
  `skill12` tinyint(1) DEFAULT 0,
  `other_skills` text DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'New',
  `application_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `job_reference`, `first_name`, `last_name`, `gender`, `dob`, `street_address`, `suburb`, `state`, `postcode`, `email`, `phone`, `skill1`, `skill2`, `skill3`, `skill4`, `skill5`, `skill6`, `skill7`, `skill8`, `skill9`, `skill10`, `skill11`, `skill12`, `other_skills`, `status`, `application_date`) VALUES
(4, 'WS25A', 'kansfoljnasf', 'OASDJFbaljfsb', NULL, NULL, 'AAOSfbnqwl', 'lwajdfbljaweg', 'NT', '4567', 'ATGAS@afgwseg.ced', '23456789', 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, '', 'New', '2025-04-03 13:40:32'),
(5, 'WS91D', 'ADGaEG', 'SDGSADG', 'female', '2000-01-24', 'aDgAEG', 'sdgsrhsarh', 'TAS', '3456', 'atajsb@ngsd.com', '12345678', 0, 1, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, '', 'New', '2025-04-03 13:50:33');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_reference` varchar(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `brief` text NOT NULL,
  `salary_range` varchar(100) NOT NULL,
  `reports_to` varchar(100) NOT NULL,
  `responsibilities` text NOT NULL,
  `requirements` text NOT NULL,
  `qualifications` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_reference`, `title`, `brief`, `salary_range`, `reports_to`, `responsibilities`, `requirements`, `qualifications`, `created_at`, `updated_at`) VALUES
(1, 'WS42X', 'UI/UX Designer', 'We\'re seeking a talented UI/UX Designer to create beautiful, intuitive interfaces for our digital products. You\'ll work closely with our development and product teams to design experiences that delight our clients and their users.', '300 - 500 million VND/year', 'Creative Director', '[\"Design user flows, wireframes, and high-fidelity mockups for web and mobile applications\",\"Collaborate with developers to implement designs and ensure pixel-perfect execution\",\"Conduct user research and usability testing to inform design decisions\",\"Create and maintain design systems and component libraries\",\"Stay current with UX\\/UI trends and best practices\",\"Present design concepts to internal teams and clients\"]', '[\"3+ years of experience in UI\\/UX design for digital products\",\"Proficiency in Figma, Adobe XD, or similar design tools\",\"Strong portfolio demonstrating user-centered design solutions\",\"Experience with responsive web design and mobile app interfaces\",\"Understanding of accessibility standards (WCAG)\",\"Excellent communication and presentation skills\"]', '[\"Bachelor\'s degree in Design, Human-Computer Interaction, or related field\",\"Experience with front-end development (HTML, CSS, JavaScript)\",\"Knowledge of animation and micro-interactions\",\"Experience in product design for SaaS applications\",\"Understanding of design thinking methodologies\"]', '2025-04-03 10:15:38', '2025-04-03 10:15:38'),
(2, 'WS78B', 'Full Stack Developer', 'We\'re looking for a talented Full Stack Developer to build and maintain innovative web applications. You\'ll work on diverse projects across various technologies and collaborate with our design and product teams to deliver exceptional digital solutions.', '400 - 650 million VND/year', 'Technical Director', '[\"Develop and maintain responsive web applications from concept to deployment\",\"Write clean, maintainable code for both front-end and back-end components\",\"Collaborate with UI\\/UX designers to implement intuitive interfaces\",\"Optimize applications for maximum speed and scalability\",\"Implement security and data protection measures\",\"Troubleshoot and debug issues across the application stack\",\"Participate in code reviews and documentation\"]', '[\"4+ years of experience in full-stack development\",\"Proficiency in JavaScript\\/TypeScript and modern frameworks (React, Vue, or Angular)\",\"Experience with server-side languages (Node.js, Python, PHP)\",\"Strong knowledge of databases (SQL and NoSQL)\",\"Experience with version control systems (Git)\",\"Understanding of web security principles\",\"Ability to work in an agile development environment\"]', '[\"Bachelor\'s degree in Computer Science or related field\",\"Experience with AWS, Azure, or other cloud platforms\",\"Knowledge of containerization (Docker, Kubernetes)\",\"Experience with CI\\/CD pipelines\",\"Contributions to open-source projects\",\"Understanding of UX principles and design systems\"]', '2025-04-03 10:15:38', '2025-04-03 10:15:38'),
(3, 'WS53P', 'Project Manager', 'We\'re seeking an experienced Project Manager to oversee our client projects from inception to completion. You\'ll coordinate cross-functional teams, manage timelines and resources, and ensure deliverables meet our high standards of quality.', '350 - 600 million VND/year', 'Operations Director', '[\"Lead project planning, execution, monitoring, and closure across multiple client engagements\",\"Define project scope, goals, deliverables, and resource allocation in collaboration with clients\",\"Create and maintain detailed project documentation, schedules, and budgets\",\"Conduct regular status meetings with internal teams and clients\",\"Identify and manage project risks, developing mitigation strategies as needed\",\"Ensure projects are delivered on time, within scope, and within budget\",\"Facilitate communication between stakeholders, development teams, and designers\"]', '[\"3+ years of experience in project management, preferably in a digital agency\",\"Strong knowledge of project management methodologies (Agile, Scrum, Waterfall)\",\"Proficiency with project management tools (Jira, Asana, Monday, etc.)\",\"Excellent communication, leadership, and client management skills\",\"Ability to manage multiple projects simultaneously\",\"Strong problem-solving abilities and attention to detail\",\"Experience with budget management and resource allocation\"]', '[\"Project Management Professional (PMP) or Agile certification\",\"Bachelor\'s degree in Business, Computer Science, or related field\",\"Understanding of software development lifecycle\",\"Experience with digital product development\",\"Knowledge of UX\\/UI design principles\",\"Client-facing experience in a creative or technology environment\"]', '2025-04-03 10:15:38', '2025-04-03 10:15:38'),
(4, 'WS91D', 'DevOps Engineer', 'We\'re looking for a skilled DevOps Engineer to streamline our development processes and infrastructure. You\'ll be responsible for building and maintaining CI/CD pipelines, managing cloud resources, and ensuring our applications are secure, scalable, and performant.', '450 - 700 million VND/year', 'Technical Director', '[\"Design, implement, and maintain CI\\/CD pipelines for application deployment\",\"Configure and manage cloud infrastructure in AWS, Azure, or GCP\",\"Implement infrastructure as code using tools like Terraform or CloudFormation\",\"Monitor system performance and optimize resource allocation\",\"Collaborate with development teams to improve deployment processes\",\"Implement security best practices and compliance requirements\",\"Automate routine operational tasks and maintenance procedures\",\"Provide technical support for production environments\"]', '[\"3+ years of experience in DevOps or Site Reliability Engineering\",\"Strong knowledge of Linux\\/Unix administration\",\"Experience with containerization technologies (Docker, Kubernetes)\",\"Proficiency with at least one cloud provider (AWS, Azure, GCP)\",\"Experience with CI\\/CD tools (Jenkins, GitLab CI, GitHub Actions)\",\"Knowledge of Infrastructure as Code (Terraform, CloudFormation)\",\"Understanding of network architecture and security principles\",\"Scripting skills (Bash, Python, or similar)\"]', '[\"Cloud certifications (AWS, Azure, or GCP)\",\"Experience with monitoring tools (Prometheus, Grafana, ELK stack)\",\"Knowledge of database administration (SQL and NoSQL)\",\"Experience with microservices architecture\",\"Familiarity with web servers and load balancers\",\"Understanding of serverless computing\"]', '2025-04-03 10:15:38', '2025-04-03 10:15:38'),
(5, 'WS67C', 'Content Strategist', 'We\'re searching for a talented Content Strategist to help shape compelling narratives for our clients. You\'ll develop content strategies, create editorial calendars, and ensure all content aligns with brand voice and business objectives while engaging target audiences.', '250 - 450 million VND/year', 'Marketing Director', '[\"Develop comprehensive content strategies aligned with client business goals\",\"Create and manage editorial calendars across multiple platforms\",\"Conduct content audits and gap analyses to identify opportunities\",\"Collaborate with designers and developers to create integrated content experiences\",\"Produce engaging copy for websites, blogs, social media, and marketing materials\",\"Develop content guidelines, tone of voice documents, and style guides\",\"Analyze content performance metrics and optimize strategies accordingly\",\"Research industry trends and competitor content to inform strategy\"]', '[\"3+ years of experience in content strategy or content marketing\",\"Excellent writing and editing skills with strong attention to detail\",\"Experience developing content for multiple channels and formats\",\"Understanding of SEO principles and content optimization\",\"Ability to translate complex concepts into clear, engaging content\",\"Experience with content management systems\",\"Strong analytical skills to measure content effectiveness\",\"Portfolio demonstrating content strategy work\"]', '[\"Bachelor\'s degree in English, Journalism, Marketing, or related field\",\"Experience with UX writing or information architecture\",\"Knowledge of content personalization techniques\",\"Familiarity with marketing automation platforms\",\"Experience in a creative agency or technology company\",\"Understanding of accessibility guidelines for content\"]', '2025-04-03 10:15:38', '2025-04-03 10:15:38'),
(6, 'WS25A', '3D Artist / Animator', 'We\'re looking for a creative 3D Artist/Animator to join our growing team. You\'ll create stunning 3D models, animations, and visual effects for client projects spanning web, mobile, AR/VR experiences, and marketing campaigns.', '240 - 420 million VND/year', 'Creative Director', '[\"Create high-quality 3D models, textures, and environments\",\"Develop character and object animations for interactive experiences\",\"Collaborate with designers and developers to integrate 3D elements\",\"Create visual effects and motion graphics for digital products\",\"Optimize 3D assets for various platforms including web and mobile\",\"Assist in developing AR\\/VR experiences and interactive installations\",\"Stay current with 3D modeling and animation trends and techniques\",\"Participate in brainstorming sessions and concept development\"]', '[\"2+ years of professional experience in 3D modeling and animation\",\"Proficiency with industry-standard 3D software (Blender, Maya, Cinema 4D)\",\"Strong understanding of 3D modeling principles, topology, and texturing\",\"Experience with animation principles and character rigging\",\"Knowledge of lighting, rendering, and compositing techniques\",\"Ability to work with art direction and meet project requirements\",\"Strong portfolio demonstrating 3D modeling and animation skills\"]', '[\"Degree or certification in 3D Animation, Game Design, or related field\",\"Experience with real-time engines (Unity, Unreal)\",\"Knowledge of WebGL and web-based 3D technologies (Three.js)\",\"Experience with AR\\/VR development\",\"Understanding of UI\\/UX design principles\",\"Familiarity with motion capture techniques\",\"Skills in traditional art or 2D animation\"]', '2025-04-03 10:15:38', '2025-04-03 10:15:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `role` varchar(20) NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `first_name`, `last_name`, `role`, `created_at`) VALUES
(1, 'admin@workshophr.com', 'admin123', 'Admin', 'User', 'HR', '2025-04-03 08:07:24'),
(2, 'itsanemail@gmail.com', 'testtest', 'Khoa', 'Nguyen', 'user', '2025-04-03 08:28:03'),
(3, 'heresmyemail@gmail.com', '12345678', 'test', 'account', 'user', '2025-04-03 09:01:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`),
  ADD KEY `idx_job_reference` (`job_reference`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `job_reference` (`job_reference`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
