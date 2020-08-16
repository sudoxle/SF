-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2019 at 09:51 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sf`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `applicant_id` int(11) NOT NULL,
  `applicant_firstname` text NOT NULL,
  `applicant_middlename` text NOT NULL,
  `applicant_lastname` text NOT NULL,
  `applicant_gender` varchar(45) NOT NULL,
  `applicant_birthdate` text NOT NULL,
  `applicant_address` text NOT NULL,
  `applicant_mobile` varchar(45) NOT NULL,
  `applicant_email_address` text NOT NULL,
  `applicant_date_registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `applicant_username` varchar(45) NOT NULL,
  `applicant_password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`applicant_id`, `applicant_firstname`, `applicant_middlename`, `applicant_lastname`, `applicant_gender`, `applicant_birthdate`, `applicant_address`, `applicant_mobile`, `applicant_email_address`, `applicant_date_registered`, `applicant_username`, `applicant_password`) VALUES
(1, 'Juan1', 'dsa', 'dela Cruz', 'Male', '02/19/2019', 'Butuan City', '91232433536', 'juan@gmail.com', '2019-02-19 07:01:22', 'juan1', 'juan1'),
(2, 'Shanine', 'Abella', 'Penduko', 'Female', '02/09/2010', 'Ambot', '92381743293', 'shanine@gmail.com', '2019-02-19 09:02:00', 'shanine1', 'shanine1'),
(3, 'Axle', 'Clarin', 'Moreno', 'Male', '10/24/1998', '153 mercedez village, south montilla blvd butuan city', '09171259448', 'ajcmoreno24@gmail.com', '2019-02-22 00:39:02', 'axlejoshmoreno', 'morenojoSH24'),
(4, 'xceel', '', 'Nomore', 'Male', '10/28/1998', 'butuan city', '9123456789', 'nomoren28@gmail.com', '2019-02-27 15:06:00', 'xle24', 'morenojoSH24'),
(5, 'kirby', 'ad', 'Mallare', 'Male', '10/27/1998', '153 mercedez village, south montilla blvd butuan city', '09171259448', 'ajcmoreno24@gmail.com', '2019-03-01 06:02:39', 'kirby', '12345'),
(6, 'kirby', 'asda', 'Mallara', 'Male', '10/27/1998', '153 mercedez village, south montilla blvd butuan city', '09171259448', 'ajcmoreno24@gmail.com', '2019-03-01 06:03:57', 'admin', '12345'),
(7, 'aires', 'asdf', 'cortes', 'Male', '10/24/1998', '153 mercedez village, south montilla blvd butuan city', '09171259448', 'ajcmoreno24@gmail.com', '2019-03-06 02:26:22', 'aires12345', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_organizations`
--

CREATE TABLE `applicant_organizations` (
  `applicant_organization_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `applicant_organization_date_applied` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `applicant_organization_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant_organizations`
--

INSERT INTO `applicant_organizations` (`applicant_organization_id`, `applicant_id`, `organization_id`, `applicant_organization_date_applied`, `applicant_organization_status`) VALUES
(2, 1, 18, '2019-02-19 09:27:51', 'Pending'),
(5, 1, 22, '2019-02-20 00:34:42', 'Approved'),
(6, 1, 11, '2019-02-20 00:40:55', 'Disapproved'),
(7, 3, 11, '2019-02-27 04:39:22', 'Pending'),
(8, 4, 9, '2019-02-27 15:07:36', 'Pending'),
(9, 6, 11, '2019-03-01 06:06:16', 'Pending'),
(10, 6, 13, '2019-03-03 09:07:04', 'Pending'),
(11, 6, 8, '2019-03-04 04:27:39', 'Disapproved'),
(12, 7, 13, '2019-03-06 02:51:07', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `applicant_organization_messages`
--

CREATE TABLE `applicant_organization_messages` (
  `applicant_organization_message_id` int(11) NOT NULL,
  `applicant_organization_message` text NOT NULL,
  `applicant_organization_message_status` text NOT NULL,
  `applicant_organization_message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `applicant_organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant_organization_messages`
--

INSERT INTO `applicant_organization_messages` (`applicant_organization_message_id`, `applicant_organization_message`, `applicant_organization_message_status`, `applicant_organization_message_date`, `applicant_organization_id`) VALUES
(4, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s. Over the years, sometimes by accident, sometimes on purpose (injected humour and the like). ', 'Approved', '2019-02-20 01:00:33', 5),
(5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat. ', 'Approved', '2019-02-20 01:13:24', 6),
(6, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat. ', 'Disapproved', '2019-02-20 01:14:14', 6),
(7, 'congrats', 'Approved', '2019-03-01 06:14:21', 9),
(8, 'pangit ka!!', 'Disapproved', '2019-03-01 06:19:48', 9),
(9, 'good', 'Approved', '2019-03-03 09:02:15', 9),
(10, 'sayang\n', 'Disapproved', '2019-03-03 09:07:40', 10),
(11, 'Sorry you''re scholarship application has been disapproved due to the following reason: ', 'Disapproved', '2019-03-04 04:47:16', 11),
(12, 'Sorry you''re scholarship application has been disapproved due to the following reason: ', 'Disapproved', '2019-03-04 04:47:22', 11);

-- --------------------------------------------------------

--
-- Table structure for table `applicant_requirements`
--

CREATE TABLE `applicant_requirements` (
  `applicant_requirement_id` int(11) NOT NULL,
  `applicant_requirement_file_path` text NOT NULL,
  `organization_id` int(11) NOT NULL,
  `applicant_organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `applicant_requirements`
--

INSERT INTO `applicant_requirements` (`applicant_requirement_id`, `applicant_requirement_file_path`, `organization_id`, `applicant_organization_id`) VALUES
(1, '2-0-dela Cruz.jpg', 18, 2),
(2, '2-1-dela Cruz.docx', 18, 2),
(3, '2-2-dela Cruz.docx', 18, 2),
(4, '5-0-dela Cruz.pdf', 22, 5),
(5, '5-1-dela Cruz.docx', 22, 5),
(6, '5-2-dela Cruz.docx', 22, 5),
(7, '6-0-dela Cruz.jpg', 11, 6),
(8, '6-1-dela Cruz.jpg', 11, 6),
(9, '6-2-dela Cruz.docx', 11, 6),
(10, '7-0-Moreno.jpeg', 11, 7),
(11, '7-1-Moreno.pdf', 11, 7),
(12, '7-2-Moreno.pdf', 11, 7),
(13, '8-0-Nomore.jpeg', 9, 8),
(14, '8-1-Nomore.pdf', 9, 8),
(15, '8-2-Nomore.pdf', 9, 8),
(16, '9-0-Mallara.pdf', 11, 9),
(17, '9-1-Mallara.pdf', 11, 9),
(18, '9-2-Mallara.jpeg', 11, 9),
(19, '10-0-Mallara.pdf', 13, 10),
(20, '10-1-Mallara.pdf', 13, 10),
(21, '10-2-Mallara.pdf', 13, 10),
(22, '11-0-Mallara.jpeg', 8, 11),
(23, '11-1-Mallara.jpg', 8, 11),
(24, '11-2-Mallara.jpg', 8, 11),
(25, '11-3-Mallara.jpg', 8, 11),
(26, '12-0-cortes.pdf', 13, 12),
(27, '12-1-cortes.pdf', 13, 12),
(28, '12-2-cortes.pdf', 13, 12),
(29, '12-3-cortes.pdf', 13, 12);

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `organization_id` int(11) NOT NULL,
  `organization_name` text NOT NULL,
  `organization_address` text NOT NULL,
  `organization_contact_no` varchar(45) NOT NULL,
  `organization_email_address` text NOT NULL,
  `organization_type` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `organization_scholarship_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`organization_id`, `organization_name`, `organization_address`, `organization_contact_no`, `organization_email_address`, `organization_type`, `user_id`, `organization_scholarship_description`) VALUES
(7, 'Caraga State University - Main Campus (TESDA)', 'Ampayon, Butuan City', '(085) 341-2296', 'carsu.edu.ph@gmail.com', 'TVI (Technical-Vocational Institution)', 1, 'This scholarship Caraga State University - Main Campus'),
(8, 'Department of Science and Technology (DOST)', 'DOP Bldg., Government Center, Tiniwisan, Butuan City', '(085) 342-5684', 'seischolarships@gmail.com', 'Non-Academe', 1, 'S&T Undergraduate Scholarships Program aims to stimulate and entice talented Filipino youths to pursue lifetime productive careers in science and technology and ensure a steady, adequate supply of qualified S&T human resources which can steer the country towards national progress.\n\n\nTHIS SCHOLARSHIP CAN BE USED IN ALL SCHOOLS IN BUTUAN'),
(9, 'ACLC COLLEGE OF BUTUAN CITY (TESDA)', 'HDS Bldg., J.C, Aquino Avenue, Butuan City', '(085)341-57195', 'AMA@yahoo.com.phrr', 'TVI (Technical-Vocational Institution)', 1, 'This scholarship is only for ACLC'),
(10, 'BUTUAN CITY BARANGAY SCHOLARSHIP PROGRAM', 'Jose Rosales Ave, Butuan City, 8600 Agusan Del Norte', '09154499094', 'bxubrgyscholar@gmail.com', 'Non-Academe', 1, 'This scholarship can be used  on any course and  any school in butuan except CSU:'),
(11, 'Commission on Higher Education (CHED)', 'Caraga State University, Ampayon, Butuan City, Agusan Del Norte, AH26, Butuan City, 8600 Agusan Del Norte', '(085) 342 5253', 'chedbutuan@gmail.com', 'Non-Academe', 1, 'General Qualifications:\n\nMust be a Filipino citizen;\nMust be a high school graduate; candidate for graduation; with earned units in college; passer of Alternative Learning System (ALS) / Philippine Educational Placement Test (PEPT);\nMust have a combined annual gross income of parents/guardian not to exceed Three Hundred Thousand Pesos (PhP 300,000.00)*;\nMust avail of only one CHED scholarship or financial assistance program; and\nMust not be a graduate of any degree program.\n\n* In highly exceptional cases where income exceeds PhP300,000.00, the CHEDRO StuFAPs Committee shall determine the merits of the application. \nplease download hfh:https://ched.gov.ph/wp-content/uploads/2017/07/Certification-Authentication-and-Verification-CAV-Application-Form.docx\n\nnote: This scholarship can be used to all schools in butuan city'),
(13, 'Father Saturnino Urios University (FSUU)', 'Office of Admissions and Scholarship\nCBS Building Ground Floor\nMain Campus\nSan Francisco Street Cor. J.C. Aquino Ave.\nButuan City, Caraga, Philippines', '+63 085 342.1830', 'vpadmin@urios.edu.ph', 'Academe', 1, 'GENERAL REQUIREMENTS FOR FSUU FUNDED AND ENTRUSTED SCHOLARSHIPS\n\nPLEASE BRING THE FOLLOWING:\nLatest Water and Electric Bills\n   Latest 2x2 color photo\n   Testing Fee: Php 350.00\n   Long brown envelope\nIncome Tax Return (ITR) of parents \nWater and Electric bills \nCertificate of being indigent from the Barangay \nPays Slip of employed parents\n\nNOTE: FSUU HUMAN RESOURCE SCHOLARSHIP applicants are \nexempted in submitting the following:\n\n1) Income Tax Return (ITR) of parents \n2) Water and Electric bills \n3) Certificate of being indigent from the Barangay \n4) Pays Slip of employed parents\n\nTHIS SCHOLARSHIP IS FOR FSUU ONLY'),
(14, 'ASIAN COLLEGE FOUNDATION (TESDA)', 'Estipona Village, Km. 3. J.C Aquino Avenue, Butuan City', '(085)815-3646', 'asian_acf@yahoo.com.ph', 'TVI (Technical-Vocational Institution)', 1, 'This Scholarship is for ASIAN COLLEGE FOUNDATION only\n\nTHIS SCHOLARSHIP IS FOR  ASIAN COLLEGE FOUNDATION ONLY'),
(15, 'Butuan City Colleges (TESDA)', 'Montilla Boulevard, Butuan City', '(085)300-3179', 'butuancitycollegesbc@gmail.com', 'TVI (Technical-Vocational Institution)', 1, 'This Scholarship if for Butuan City Colleges'),
(16, 'Holy Child Colleges (TESDA)', '2nd Street, Guingona Subdivision, Butuan City', '(085)342-3975', 'hccbxu@gmail.com', 'TVI (Technical-Vocational Institution)', 1, 'THIS SCHOLARSHIP IS FOR Holy Child Colleges (TESDA) ONLY'),
(17, 'LE'' OPHIR LEARNING SCHOOL (TESDA)', 'Ochoa, Avenue, Butuan City', '(085)816-1105', 'la_ophir@yahoo.com', 'TVI (Technical-Vocational Institution)', 1, 'THIS SCHOLARSHIP IS FOR LE'' OPHIR LEARNING SCHOOL ONLY'),
(18, 'MANA MILLENIUM TECHNICAL SCHOOL (TESDA)', '4F Balibrea Building, Pili Drive, Butuan City', '(085)817-2006', 'manatech.butuan@gmail.com', 'TVI (Technical-Vocational Institution)', 1, 'MANA MILLENIUM TECHNICAL SCHOOL (TESDA)'),
(19, 'Philippine Electronics & Communication Institute of Technology (TESDA)', 'Imadejas Subdivision, Butuan City', '(085)341-7660', 'pecit_education@yahoo.com', 'TVI (Technical-Vocational Institution)', 1, 'PECIT (TESDA)'),
(20, 'RELIANCE TRAINING INSTITUTE (TESDA)', 'F. Durano Street, Butuan City', '(085)816-2812', 'reliance.bxu-tech@relianceti.com', 'TVI (Technical-Vocational Institution)', 1, 'THIS SCHOLARSHIP FOR ONLY RELIANCE TRAINING INSTITUTE (TESDA)'),
(21, 'Saint Joseph Institute of Technology (TESDA)', 'Montilla Boulevard, Butuan City', '(085)225-5039', 'sjit@gmail.com', 'TVI (Technical-Vocational Institution)', 1, 'THIS SCHOLARSHIP IS FOR SJIT (TESDA) ONLY'),
(22, 'Butuan Doctors Hospital College (TESDA)', 'J.C. Aquino Avenue, Butuan City', '(085)225-6849', 'bdhc@gmail.com', 'TVI (Technical-Vocational Institution)', 1, 'BDHC (TESDA)'),
(23, 'Center for Healthcare Professions (TESDA)', '3F S & V Building., R. Calo Street, Butuan City', '(085)225-6849', 'chp_butuan09@yahoo.com', 'TVI (Technical-Vocational Institution)', 1, 'THIS SCHOLARSHIP IS FOR Center For Healthcare Professions Butuan ONLY'),
(24, 'FATHER SATURNINO URIOS UNIVERSITY (TESDA)', 'San Francisco Street, Butuan City', '(085)342-1830', 'fsuu@gmail.com', 'TVI (Technical-Vocational Institution)', 1, 'FATHER SATURNINO URIOS UNIVERSITY (TESDA)\n\nTHIS SCHOLARSHIP IS FOR FSUU (TESDA) ONLY:');

-- --------------------------------------------------------

--
-- Table structure for table `organization_courses`
--

CREATE TABLE `organization_courses` (
  `organization_course_id` int(11) NOT NULL,
  `organization_course` text NOT NULL,
  `organization_course_type` text NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization_courses`
--

INSERT INTO `organization_courses` (`organization_course_id`, `organization_course`, `organization_course_type`, `organization_id`) VALUES
(245, 'ALL COURSES (except CSU)', 'Bachelors Degree', 10),
(246, 'ALL COURSES (except CSU)', '2 Year Degree Course', 10),
(247, 'ALL COURSES (except CSU)', 'Vocational Course', 10),
(311, '232-hour Rice Machinery Operations NC II', 'Vocational Course', 7),
(336, '1-year Seafarer -Stewarding NC I', 'Vocational Course', 21),
(337, '528-hours Automotive Servicing NC II', 'Vocational Course', 21),
(338, '436-hours Commercial Cooking NC II', 'Vocational Course', 21),
(339, '996-hours Health Care Services NC II', 'Vocational Course', 21),
(340, '436-hours Housekeeping NC II', 'Vocational Course', 21),
(341, '268-hours Shielded Metal Arc Welding NC II', 'Vocational Course', 21),
(342, '268-hours Shilede Metal Arc Welding NC II', 'Vocational Course', 9),
(343, '840-hours 2D Animation NC III', 'Vocational Course', 14),
(344, '280-hours Computer Systems Servicing NC II', 'Vocational Course', 14),
(345, '2-years Computer Based Accounting', 'Vocational Course', 14),
(346, '178-hours Barista NC II', 'Vocational Course', 22),
(347, '486-hours Bartending NC II', 'Vocational Course', 22),
(348, '436-hours Front Office Service II', 'Vocational Course', 22),
(349, '436-hours housekeeping NC II', 'Vocational Course', 22),
(352, '786-hours caregiving NC II', 'Vocational Course', 23),
(353, '218-hours domestic work NC II', 'Vocational Course', 23),
(354, '286-hours Bartending NC II', 'Vocational Course', 24),
(355, '336-hours Food and Beverage Services NC II', 'Vocational Course', 24),
(356, '252-hours Computer Programming NC IV', 'Vocational Course', 24),
(357, '286-hours Bartending NC II', 'Vocational Course', 16),
(358, '2-year Broadcast Communication', 'Vocational Course', 16),
(359, '786-hours Food and Beverage Services NC II', 'Vocational Course', 16),
(360, '2-year Computer Secretarial', 'Vocational Course', 16),
(361, '336-hour Food and Beverage Services NC II', 'Vocational Course', 16),
(362, '436-hours Housekeeping NC II', 'Vocational Course', 16),
(363, '2-year Occupational Therapy', 'Vocational Course', 16),
(364, '206-hours Security Services NC I', 'Vocational Course', 16),
(365, '372-hours Security Services NC I', 'Vocational Course', 16),
(366, '2-year Tourism Management', 'Vocational Course', 16),
(367, '252-hours Computer Programming NC IV', 'Vocational Course', 16),
(368, '292-hours bookeeping  NC  III', 'Vocational Course', 15),
(369, '108-hours events manager service NC III', 'Vocational Course', 15),
(370, '108-hours Events Management Services NC III', 'Vocational Course', 17),
(371, '292-hours Bookkeeping NC III', 'Vocational Course', 17),
(372, '396-hours Medical Transcription NC II', 'Vocational Course', 20),
(373, '122-hours Heavy Equipment Operation (on-Highway Dump Truck [Rigid]) NC II', 'Vocational Course', 18),
(377, '280-hours Computer Systems Servicing NC II', 'Vocational Course', 19),
(378, '260-hours Electronic Products Assembly and Servicing NC II', 'Vocational Course', 19),
(379, '356-hours Food and Beverage Services NC II', 'Vocational Course', 19),
(452, 'Agro-Forestry', 'Bachelors Degree', 11),
(453, 'Veterinary Medicine', 'Bachelors Degree', 11),
(454, 'Agricultural Engineering', 'Bachelors Degree', 11),
(455, 'Agribusiness/Management', 'Bachelors Degree', 11),
(456, 'Agricultural Entrepreneurship', 'Bachelors Degree', 11),
(457, 'Mechanical Engineering', 'Bachelors Degree', 11),
(458, 'Electronics Engineering', 'Bachelors Degree', 11),
(459, 'Communication Engineering', 'Bachelors Degree', 11),
(460, 'Metallurgical/Mining Engineering', 'Bachelors Degree', 11),
(461, 'Computer Engineering', 'Bachelors Degree', 11),
(462, 'BS Mathematics', 'Bachelors Degree', 11),
(463, 'BS Physics', 'Bachelors Degree', 11),
(464, 'BS Biology', 'Bachelors Degree', 11),
(465, 'BS Chemistry', 'Bachelors Degree', 11),
(466, 'BS Marine Biology/Science', 'Bachelors Degree', 11),
(467, 'Information Technology and Computing Studies', 'Bachelors Degree', 11),
(468, 'Bachelor in Library Science & Information System Major in System Analysis', 'Bachelors Degree', 11),
(469, 'Computer Science', 'Bachelors Degree', 11),
(470, 'Teacher Education major in Mathematics', 'Bachelors Degree', 11),
(471, 'Teacher Education major in Science', 'Bachelors Degree', 11),
(472, 'Teacher Education major in Physics', 'Bachelors Degree', 11),
(473, 'Teacher Education major in Chemistry', 'Bachelors Degree', 11),
(474, 'Teacher Education major in English', 'Bachelors Degree', 11),
(475, 'Pharmacy', 'Bachelors Degree', 11),
(476, 'Radiology Technology', 'Bachelors Degree', 11),
(477, 'Medical Technology', 'Bachelors Degree', 11),
(478, 'Physical Therapy', 'Bachelors Degree', 11),
(479, 'BS Nutrition', 'Bachelors Degree', 11),
(480, 'Bachelor of Science in Accountancy', 'Bachelors Degree', 13),
(481, 'Bachelor of Science in Accounting Technology', 'Bachelors Degree', 13),
(482, 'Bachelor of Arts in Communication', 'Bachelors Degree', 13),
(483, 'Bachelor of Arts in Political Science', 'Bachelors Degree', 13),
(484, 'Bachelor of Arts in Guidance and Counseling', 'Bachelors Degree', 13),
(485, 'Bachelor of Arts in Economics Bachelor of Arts in Filiipino Language ', 'Bachelors Degree', 13),
(486, 'Bachelor of Arts in English Language', 'Bachelors Degree', 13),
(487, ' Bachelor of Science in Applied Mathematics', 'Bachelors Degree', 13),
(488, 'Bachelor of Science in Biology', 'Bachelors Degree', 13),
(489, 'BSBA in Financial Management ', 'Bachelors Degree', 13),
(490, 'BSBA in Marketing Management ', 'Bachelors Degree', 13),
(491, 'BSBA in Operations Management', 'Bachelors Degree', 13),
(492, 'BSBA in Human Resource Management and Development', 'Bachelors Degree', 13),
(493, 'Bachelor of Science in Social Entrepreneurship', 'Bachelors Degree', 13),
(494, 'Bachelor of Science in Office Administration', 'Bachelors Degree', 13),
(495, 'Bachelor of Science in Computer Science', 'Bachelors Degree', 13),
(496, ' Bachelor of Science in Information Technology', 'Bachelors Degree', 13),
(497, 'Bachelor of Science in Information Technology Major in Animation Computer Programming NC IV', 'Bachelors Degree', 13),
(498, 'Computer Hardware Servicing NC II', 'Bachelors Degree', 13),
(499, 'Bachelor of Science in Civil Engineering', 'Bachelors Degree', 13),
(500, 'Bachelor of Science in Industrial Engineering ', 'Bachelors Degree', 13),
(501, 'Bachelor of Laws', 'Bachelors Degree', 13),
(502, 'Bachelor of Science in Criminology', 'Bachelors Degree', 13),
(503, 'Bachelor of Science in Nursing', 'Bachelors Degree', 13),
(504, 'Bachelor in Secondary Education Major in Science ', 'Bachelors Degree', 13),
(505, 'Bachelor in Secondary Education Major in Filipino', 'Bachelors Degree', 13),
(506, 'Bachelor in Secondary Education Major in English ', 'Bachelors Degree', 13),
(507, 'Bachelor in Secondary Education Major in Mathematics', 'Bachelors Degree', 13),
(508, 'Bachelor in Secondary Education Major in Social Studies', 'Bachelors Degree', 13),
(509, 'Bachelor in Secondary Education Major in Biological Science', 'Bachelors Degree', 13),
(510, 'Bachelor in Physical Education Major in School PE', 'Bachelors Degree', 13),
(511, 'Bachelor in Elementary Education Major in General Education ', 'Bachelors Degree', 13),
(512, 'Bachelor in Elementary Education Major in Special Education', 'Bachelors Degree', 13),
(513, 'Bachelor in Elementary Education Major in Pre-school Education', 'Bachelors Degree', 13),
(522, 'Aeronautical Engineering; (CSU)', 'Bachelors Degree', 8),
(523, 'Aerospace Engineering; (CSU)', 'Bachelors Degree', 8),
(524, 'Agribusiness Management; (CSU)', 'Bachelors Degree', 8),
(525, 'Applied Mathematics; (CSU, FSUU)', 'Bachelors Degree', 8),
(526, 'Biology; (FSUU)', 'Bachelors Degree', 8),
(527, 'Information Technology; (FSUU, SJIT, AMA)', 'Bachelors Degree', 8),
(528, 'Industrial Engineering; (FSUU)', 'Bachelors Degree', 8),
(529, 'Mathematics; (FSUU)', 'Bachelors Degree', 8);

-- --------------------------------------------------------

--
-- Table structure for table `organization_images`
--

CREATE TABLE `organization_images` (
  `organization_image_id` int(11) NOT NULL,
  `organization_image_file_path` text NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization_images`
--

INSERT INTO `organization_images` (`organization_image_id`, `organization_image_file_path`, `organization_id`) VALUES
(2, '7.png', 7),
(3, '10.png', 10),
(4, '8.png', 8),
(5, '11.png', 11),
(6, '13.png', 13),
(7, '9.png', 9),
(8, '14.png', 14),
(9, '22.png', 22),
(10, '15.png', 15),
(11, '23.png', 23),
(12, '24.png', 24),
(13, '16.png', 16),
(14, '17.png', 17),
(15, '19.png', 19),
(16, '18.png', 18),
(17, '20.png', 20),
(18, '21.png', 21);

-- --------------------------------------------------------

--
-- Table structure for table `organization_requirements`
--

CREATE TABLE `organization_requirements` (
  `organization_requirement_id` int(11) NOT NULL,
  `organization_requirement_description` text NOT NULL,
  `organization_requirement_is_uploadable` varchar(45) NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization_requirements`
--

INSERT INTO `organization_requirements` (`organization_requirement_id`, `organization_requirement_description`, `organization_requirement_is_uploadable`, `organization_id`) VALUES
(110, '1.Application Letter (Address to City Mayor, Engr. Ronnie Vicente Lagnada) duly signed by the applicant;', 'uploadable', 10),
(111, '2.Recommendation from the concerned  Barangay Official/Youth Representative;', 'uploadable', 10),
(112, '3.Copy of the Income Tax Return (ITR) of the applicant''s parent''s;', 'uploadable', 10),
(113, '4.Biodata with 2x 2ID', 'uploadable', 10),
(114, '5.Latest Community Tax/Cedula', 'uploadable', 10),
(115, '6.Voter''s Registration Certificate if applicant is below 18 years old please submit promissory letter to the City Mayor;', 'uploadable', 10),
(116, '7.Recent Scholastic Records (Form 148 )', 'uploadable', 10),
(117, '8.Good Moral Character(if high school graduate)  OR previous two succeeding  semestral grades duly signed by school registrar (if College level);', 'uploadable', 10),
(118, '9.Scholarship Contract Agreement with the city government of butuan;', '', 10),
(152, 'Birth Certificate (Photocopy)', 'uploadable', 7),
(153, 'form 138', 'uploadable', 7),
(154, 'Good moral character', 'uploadable', 7),
(179, 'Birth Certificate (Photocopy)', 'uploadable', 21),
(180, 'Good moral character', 'uploadable', 21),
(181, 'form 138', 'uploadable', 21),
(182, 'Birth Certificate (Photocopy)', 'uploadable', 9),
(183, 'form 138', 'uploadable', 9),
(184, 'Good moral character', 'uploadable', 9),
(185, 'Birth Certificate (Photocopy)', 'uploadable', 14),
(186, 'form 138', 'uploadable', 14),
(187, 'Good moral character', 'uploadable', 14),
(188, 'Birth Certificate (Photocopy)', 'uploadable', 22),
(189, 'form 138', 'uploadable', 22),
(190, 'Good moral character', 'uploadable', 22),
(194, 'Birth Certificate (Photocopy)', 'uploadable', 23),
(195, 'Good moral character', 'uploadable', 23),
(196, 'form 138', 'uploadable', 23),
(197, 'Birth Certificate (Photocopy) ', 'uploadable', 24),
(198, 'Good moral character ', 'uploadable', 24),
(199, 'form 138', 'uploadable', 24),
(200, 'Birth Certificate (Photocopy) ', 'uploadable', 16),
(201, 'Good moral character ', 'uploadable', 16),
(202, 'form 138', 'uploadable', 16),
(203, 'Good moral character', 'uploadable', 15),
(204, 'Birth Certificate (Photocopy)', '', 15),
(205, 'form 138', '', 15),
(206, 'Birth Certificate (Photocopy) ', 'uploadable', 17),
(207, 'Good moral character ', 'uploadable', 17),
(208, 'form 138', 'uploadable', 17),
(209, 'Birth Certificate (Photocopy)', 'uploadable', 20),
(210, 'Good moral character', 'uploadable', 20),
(211, 'form 138', 'uploadable', 20),
(212, 'Birth Certificate (Photocopy)', 'uploadable', 18),
(213, 'Good moral character', 'uploadable', 18),
(214, 'form 138', 'uploadable', 18),
(218, 'Birth Certificate (Photocopy)', 'uploadable', 19),
(219, 'Good moral character', 'uploadable', 19),
(220, 'form 138', 'uploadable', 19),
(234, '(For high school graduates) Form 138 OR (College level)  Certificate of grades in all subjects in completed semesters Other Applicants;', 'uploadable', 11),
(235, 'Any one of the following: Latest Income Tax Return (ITR) of parents or guardian, Certificate of Tax Exemption from the Bureau of Internal Revenue (BIR), Certificate of Indigency from their Barangay, Case Study from Department of Social Welfare and Development (DSWD), or Affidavit of No Income. For children of Overseas Filipino Workers (OFW) and seafarers, a latest copy of contract or proof of income may be considered.', 'uploadable', 11),
(236, 'Certificate of good moral character from the last school attended.', 'uploadable', 11),
(237, 'General Average', 'uploadable', 11),
(238, 'Filled out Scholarship Application Form', 'uploadable', 13),
(239, ' Baptismal Certificate', 'uploadable', 13),
(240, ' Recommendation letter from the  Parish Priest (THESE REQUIREMENTS ARE ONLY FOR  STUDENT ASSISTANTS, BUTUAN DIOCESE SCHOLARSHIP &  JULIETA YAP-GO SCHOLARSHIP APPLICANTS)', 'uploadable', 13),
(241, 'General Average', 'uploadable', 13),
(246, 'Application Form (https://bit.ly/2IPsDKH)', 'uploadable', 8),
(247, 'Photocopy of Birth Certificate', 'uploadable', 8),
(248, 'One recent (1”x1”) picture', 'uploadable', 8),
(249, 'NBI Clearance (Browse Picture)', 'uploadable', 8);

-- --------------------------------------------------------

--
-- Table structure for table `organization_users`
--

CREATE TABLE `organization_users` (
  `organization_user_id` int(11) NOT NULL,
  `organization_user_username` varchar(45) NOT NULL,
  `organization_user_password` varchar(45) NOT NULL,
  `organization_user_fullname` text NOT NULL,
  `organization_user_gender` varchar(45) NOT NULL,
  `organization_user_birthdate` text NOT NULL,
  `organization_user_address` text NOT NULL,
  `organization_user_mobile` varchar(45) NOT NULL,
  `organization_user_email_address` text NOT NULL,
  `organization_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `organization_users`
--

INSERT INTO `organization_users` (`organization_user_id`, `organization_user_username`, `organization_user_password`, `organization_user_fullname`, `organization_user_gender`, `organization_user_birthdate`, `organization_user_address`, `organization_user_mobile`, `organization_user_email_address`, `organization_id`) VALUES
(2, 'peter1', 'peter1', 'Peter Parker', 'Male', '10/01/1995', '', '', 'peterparker@gmail.com', 7),
(3, 'bruce1', 'bruce1', 'Bruce Wayne', 'Male', '10/04/1994', '', '', 'brucewayne@gmail.com', 8),
(4, 'wynwyn', 'wynwyn', 'wyn wyn', 'Female', '07/04/1990', 'buenavista', '09154499094', 'wynwyn@gmail.com', 10),
(5, 'fsuuadmin', 'fsuuadmin', 'FSUU', 'Male', '01/07/1990', 'buenavista', '09154499094', 'fsuu@gmail.com', 13),
(6, 'fsuuadmin', 'fsuuadmin', 'FSUU', 'Male', '01/07/1990', 'buenavista', '09154499094', 'fsuu@gmail.com', 24),
(7, 'chedadmin', 'chedadmin', 'ched admin', 'Male', '12/29/2008', 'buenavista', '09154499094', 'ched@gmail.com', 11),
(8, 'ama12345', 'ama12345', 'christian', 'Male', '10/13/2010', 'butuan city', '9123456789', 'ama@gmail.com', 9),
(9, 'acf12345', 'acf12345', 'smufry', 'Female', '02/20/1990', 'butuan city', '9123456789', 'acf@gmail.com', 14),
(10, 'bxucolleges', 'acf12345123', 'Romel', 'Male', '12/12/1990', 'butuan city', '', 'rome@gmail.com', 15),
(11, 'holychild123', 'holychild123', 'jake', 'Male', '08/14/1992', 'maon, butuan city', '9246789217', 'jaketake@gmail.com', 16),
(12, 'lols12345', 'lols12345', 'joseph', 'Male', '08/08/1991', 'golden ribbon,butuan city', '9247821578', 'joseph26@gmail.com', 17),
(13, 'manafountain', 'manafountain12345', 'lloydway123', 'Male', '07/25/1991', 'libertad, butuan city', '92948372619', 'mraxe@gmail.com', 18),
(15, 'pecit12345', 'pecit12345', 'mary', 'Female', '07/13/1991', 'imadejas, butuan city', '9121849832', 'maryme@gmail.com', 19),
(16, 'rtimeme1', 'rtimeme12', 'saccerro', 'Male', '12/28/1990', 'ampayon,butuan city', '9123123111', 'sacsa@gmail.com', 20),
(17, 'stephen12345', 'stephen12345', 'stephen john', 'Male', '02/01/1990', 'rose wood, butuan city', '9827161524', 'stejohn@gmail.com', 21),
(19, 'bdhc24123', 'bdhc12345', 'nelson', 'Male', '09/20/1989', 'cinderalla, butuan city', '925212632', 'nelson23@gmail.com', 22),
(20, 'chpph25', 'trainings', 'justin', 'Male', '08/06/1993', 'cinderalla, butuan city', '925212567', 'justin24@gmail.com', 23),
(21, 'admin1', 'admin1', 'josh', 'Male', '07/05/1995', '153 mercedez village, south montilla blvd butuan city', '09171259448', 'ajcmoreno24@gmail.com', 11);

-- --------------------------------------------------------

--
-- Table structure for table `persons`
--

CREATE TABLE `persons` (
  `person_id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text NOT NULL,
  `lastname` text NOT NULL,
  `gender` varchar(45) NOT NULL,
  `birthdate` text NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(45) NOT NULL,
  `email_address` text NOT NULL,
  `password_code` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persons`
--

INSERT INTO `persons` (`person_id`, `firstname`, `middlename`, `lastname`, `gender`, `birthdate`, `address`, `mobile`, `email_address`, `password_code`) VALUES
(1, 'Axle', '', 'Axle', 'Male', '02/19/2019', 'Bayugan City, ADS', '9469006448', 'axle@gmail.com', ''),
(2, 'Benedict kirby', 'paracuelles', 'mallare', 'Male', '08/17/1997', 'buenavista', '', 'kirby@gmai.com', NULL),
(3, 'Aires', 'Padao', 'Cortes', 'Female', '09/17/1998', 'Butuan City', '91234567890', 'aires@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `date_reg` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `person_id` int(11) NOT NULL,
  `user_role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `date_reg`, `person_id`, `user_role_id`) VALUES
(1, 'admin', 'admin123', '0000-00-00 00:00:00', 1, 1),
(2, 'benedict', '1234567', '2018-10-26 18:50:43', 2, 1),
(3, 'aires', 'admin123', '2018-10-27 04:52:28', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_modules`
--

CREATE TABLE `user_modules` (
  `user_module_id` int(11) NOT NULL,
  `user_module` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_modules`
--

INSERT INTO `user_modules` (`user_module_id`, `user_module`, `user_id`) VALUES
(2, '/setup/accessibility/persons', 1),
(3, '/setup/accessibility/users', 1),
(4, '/organizations/organizations', 1),
(5, '/organizations/organization_requirements', 1),
(6, '/organizations/organization_users', 1),
(7, '/applicants/applicants', 1),
(22, '/setup/accessibility/persons', 2),
(23, '/setup/accessibility/users', 2),
(24, '/organizations/organizations', 2),
(25, '/organizations/organization_requirements', 2),
(26, '/organizations/organization_users', 2),
(27, '/applicants/applicants', 2),
(34, '/setup/accessibility/persons', 3),
(35, '/setup/accessibility/users', 3),
(36, '/organizations/organizations', 3),
(37, '/organizations/organization_requirements', 3),
(38, '/organizations/organization_users', 3),
(39, '/applicants/applicants', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_role_id` int(11) NOT NULL,
  `user_role` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `user_role`) VALUES
(1, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`applicant_id`);

--
-- Indexes for table `applicant_organizations`
--
ALTER TABLE `applicant_organizations`
  ADD PRIMARY KEY (`applicant_organization_id`),
  ADD KEY `fk_applicant_organizations_applicants1_idx` (`applicant_id`),
  ADD KEY `fk_applicant_organizations_organizations1_idx` (`organization_id`);

--
-- Indexes for table `applicant_organization_messages`
--
ALTER TABLE `applicant_organization_messages`
  ADD PRIMARY KEY (`applicant_organization_message_id`),
  ADD KEY `fk_applicant_organization_messages_applicant_organizations1_idx` (`applicant_organization_id`);

--
-- Indexes for table `applicant_requirements`
--
ALTER TABLE `applicant_requirements`
  ADD PRIMARY KEY (`applicant_requirement_id`),
  ADD KEY `fk_applicant_requirements_organizations1_idx` (`organization_id`),
  ADD KEY `fk_applicant_requirements_applicant_organizations1_idx` (`applicant_organization_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`organization_id`),
  ADD KEY `fk_organizations_users1_idx` (`user_id`);

--
-- Indexes for table `organization_courses`
--
ALTER TABLE `organization_courses`
  ADD PRIMARY KEY (`organization_course_id`),
  ADD KEY `fk_organization_courses_organizations1_idx` (`organization_id`);

--
-- Indexes for table `organization_images`
--
ALTER TABLE `organization_images`
  ADD PRIMARY KEY (`organization_image_id`),
  ADD KEY `fk_organization_images_organizations1_idx` (`organization_id`);

--
-- Indexes for table `organization_requirements`
--
ALTER TABLE `organization_requirements`
  ADD PRIMARY KEY (`organization_requirement_id`),
  ADD KEY `fk_organization_requirements_organizations1_idx` (`organization_id`);

--
-- Indexes for table `organization_users`
--
ALTER TABLE `organization_users`
  ADD PRIMARY KEY (`organization_user_id`),
  ADD KEY `fk_organization_users_organizations1_idx` (`organization_id`);

--
-- Indexes for table `persons`
--
ALTER TABLE `persons`
  ADD PRIMARY KEY (`person_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_users_user_roles_idx` (`user_role_id`),
  ADD KEY `fk_users_persons1_idx` (`person_id`);

--
-- Indexes for table `user_modules`
--
ALTER TABLE `user_modules`
  ADD PRIMARY KEY (`user_module_id`),
  ADD KEY `fk_user_modules_users1_idx` (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `applicant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `applicant_organizations`
--
ALTER TABLE `applicant_organizations`
  MODIFY `applicant_organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `applicant_organization_messages`
--
ALTER TABLE `applicant_organization_messages`
  MODIFY `applicant_organization_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `applicant_requirements`
--
ALTER TABLE `applicant_requirements`
  MODIFY `applicant_requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `organization_courses`
--
ALTER TABLE `organization_courses`
  MODIFY `organization_course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530;
--
-- AUTO_INCREMENT for table `organization_images`
--
ALTER TABLE `organization_images`
  MODIFY `organization_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `organization_requirements`
--
ALTER TABLE `organization_requirements`
  MODIFY `organization_requirement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;
--
-- AUTO_INCREMENT for table `organization_users`
--
ALTER TABLE `organization_users`
  MODIFY `organization_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `persons`
--
ALTER TABLE `persons`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_modules`
--
ALTER TABLE `user_modules`
  MODIFY `user_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `applicant_organizations`
--
ALTER TABLE `applicant_organizations`
  ADD CONSTRAINT `fk_applicant_organizations_applicants1` FOREIGN KEY (`applicant_id`) REFERENCES `applicants` (`applicant_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_applicant_organizations_organizations1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `applicant_organization_messages`
--
ALTER TABLE `applicant_organization_messages`
  ADD CONSTRAINT `fk_applicant_organization_messages_applicant_organizations1` FOREIGN KEY (`applicant_organization_id`) REFERENCES `applicant_organizations` (`applicant_organization_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `applicant_requirements`
--
ALTER TABLE `applicant_requirements`
  ADD CONSTRAINT `fk_applicant_requirements_applicant_organizations1` FOREIGN KEY (`applicant_organization_id`) REFERENCES `applicant_organizations` (`applicant_organization_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_applicant_requirements_organizations1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `organizations`
--
ALTER TABLE `organizations`
  ADD CONSTRAINT `fk_organizations_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `organization_courses`
--
ALTER TABLE `organization_courses`
  ADD CONSTRAINT `fk_organization_courses_organizations1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `organization_images`
--
ALTER TABLE `organization_images`
  ADD CONSTRAINT `fk_organization_images_organizations1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `organization_requirements`
--
ALTER TABLE `organization_requirements`
  ADD CONSTRAINT `fk_organization_requirements_organizations1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `organization_users`
--
ALTER TABLE `organization_users`
  ADD CONSTRAINT `fk_organization_users_organizations1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`organization_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_persons1` FOREIGN KEY (`person_id`) REFERENCES `persons` (`person_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_user_roles` FOREIGN KEY (`user_role_id`) REFERENCES `user_roles` (`user_role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_modules`
--
ALTER TABLE `user_modules`
  ADD CONSTRAINT `fk_user_modules_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
