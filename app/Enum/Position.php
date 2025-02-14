<?php

namespace App\Enum;

use App\Traits\HasEnumOptions;

enum Position: string
{
    use HasEnumOptions;
    case ACCOUNTANT_I = 'Accountant I';
    case ACCOUNTANT_II = 'Accountant II';
    case ACCOUNTANT_III = 'Accountant III';
    case ACCOUNTANT_IV = 'Accountant IV';
    case ADMINISTRATIVE_AIDE_I = 'Administrative Aide I';
    case ADMINISTRATIVE_AIDE_II = 'Administrative Aide II';
    case ADMINISTRATIVE_AIDE_III = 'Administrative Aide III';
    case ADMINISTRATIVE_AIDE_IV = 'Administrative Aide IV';
    case ADMINISTRATIVE_AIDE_V = 'Administrative Aide V';
    case ADMINISTRATIVE_AIDE_VI = 'Administrative Aide VI';
    case ADMINISTRATIVE_ASSISTANT_I = 'Administrative Assistant I';
    case ADMINISTRATIVE_ASSISTANT_II = 'Administrative Assistant II';
    case ADMINISTRATIVE_ASSISTANT_III = 'Administrative Assistant III';
    case ADMINISTRATIVE_ASSISTANT_IV = 'Administrative Assistant IV';
    case ADMINISTRATIVE_ASSISTANT_V = 'Administrative Assistant V';
    case ADMINISTRATIVE_OFFICER_I = 'Administrative Officer I';
    case ADMINISTRATIVE_OFFICER_II = 'Administrative Officer II';
    case ADMINISTRATIVE_OFFICER_III = 'Administrative Officer III';
    case ADMINISTRATIVE_OFFICER_IV = 'Administrative Officer IV';
    case ADMINISTRATIVE_OFFICER_V = 'Administrative Officer V';
    case AGRICULTURAL_TECHNICIAN_I = 'Agricultural Technician I';
    case AGRICULTURAL_TECHNICIAN_II = 'Agricultural Technician II';
    case ARCHITECT_III = 'Architect III';
    case ARMORER_I = 'Armorer I';
    case ASSISTANT_PROFESSOR_I = 'Assistant Professor I';
    case ASSISTANT_PROFESSOR_II = 'Assistant Professor II';
    case ASSISTANT_PROFESSOR_III = 'Assistant Professor III';
    case ASSISTANT_PROFESSOR_IV = 'Assistant Professor IV';
    case ASSOCIATE_PROFESSOR_I = 'Associate Professor I';
    case ASSOCIATE_PROFESSOR_II = 'Associate Professor II';
    case ASSOCIATE_PROFESSOR_III = 'Associate Professor III';
    case ASSOCIATE_PROFESSOR_IV = 'Associate Professor IV';
    case ASSOCIATE_PROFESSOR_V = 'Associate Professor V';
    case ATTORNEY_II = 'Attorney II';
    case ATTORNEY_IV = 'Attorney IV';
    case BOARD_SECRETARY_I = 'Board Secretary I';
    case BOOKKEEPER = 'BOOKKEEPER';
    case CARPENTER_II = 'Carpenter II';
    case CENSUS_RESEARCH_ASSISTANT = 'Census Research Assistant';
    case CHIEF_ADMINISTRATIVE_OFFICER = 'Chief Administrative Officer';
    case CHIEF_SCIENCE_RESEARCH_SPECIALIST = 'Chief Science Research Specialist';
    case COLLEGE_LIBRARIAN_I = 'College Librarian I';
    case COLLEGE_LIBRARIAN_II = 'College Librarian II';
    case COLLEGE_LIBRARIAN_III = 'College Librarian III';
    case COLLEGE_LIBRARIAN_IV = 'College Librarian IV';
    case COMPUTER_MAINTENANCE_TECHNOLOGIST_I = 'Computer Maintenance Technologist I';
    case COMPUTER_OPERATOR_I = 'Computer Operator I';
    case COMPUTER_PROGRAMMER_I = 'Computer Programmer I';
    case CONSTRUCTION_AND_MAINTENANCE_FOREMAN = 'Construction and Maintenance Foreman';
    case CONSTRUCTION_AND_MAINTENANCE_MAN = 'Construction and Maintenance Man';
    case COOK_I = 'Cook I';
    case COOK_II = 'Cook II';
    case CRAFTS_EDUCATION_DEMONSTRATOR_I = 'Crafts Education Demonstrator I';
    case DENTAL_AIDE = 'Dental Aide';
    case DORMITORY_MANAGER_I = 'Dormitory Manager I';
    case DORMITORY_MANAGER_II = 'Dormitory Manager II';
    case DRAFTSMAN_I = 'Draftsman I';
    case EDUCATION_RESEARCH_ASSISTANT_II = 'Education Research Assistant II';
    case ELECTRICIAN_I = 'Electrician I';
    case EXECUTIVE_ASSISTANT_IV = 'Executive Assistant IV';
    case FARM_SUPERVISOR = 'Farm Supervisor';
    case FARM_WORKER_I = 'Farm Worker I';
    case FARM_WORKER_II = 'Farm Worker II';
    case FOOD_SERVICE_SUPERVISOR_III = 'Food Service Supervisor III';
    case FOREST_RANGER = 'Forest Ranger';
    case GUIDANCE_COORDINATOR_I = 'Guidance Coordinator I';
    case GUIDANCE_COUNSELOR_I = 'Guidance Counselor I';
    case HANDICRAFT_WORKER_II = 'Handicraft Worker II';
    case HEAVY_EQUIPMENT_OPERATOR_I = 'Heavy Equipment Operator I';
    case HEAVY_EQUIPMENT_OPERATOR_II = 'Heavy Equipment Operator II';
    case HOUSEPARENT_I = 'Houseparent I';
    case INFORMATION_OFFICER_I = 'Information Officer I';
    case INFORMATION_OFFICER_III = 'Information Officer III';
    case INFORMATION_SYSTEMS_ANALYST_I = 'Information Systems Analyst I';
    case INFORMATION_SYSTEMS_ANALYST_II = 'Information Systems Analyst II';
    case INFORMATION_SYSTEMS_RESEARCHER_II = 'Information Systems Researcher II';
    case INFORMATION_TECHNOLOGY_OFFICER_I = 'Information Technology Officer I';
    case INSTRUCTOR_I = 'Instructor I';
    case INSTRUCTOR_II = 'Instructor II';
    case INSTRUCTOR_III = 'Instructor III';
    case INTERNAL_AUDITOR_I = 'Internal Auditor I';
    case INTERNAL_AUDITOR_II = 'Internal Auditor II';
    case INTERNAL_AUDITOR_III = 'Internal Auditor III';
    case LABORATORY_AIDE_I = 'Laboratory Aide I';
    case LABORATORY_TECHNICIAN_I = 'Laboratory Technician I';
    case LABORATORY_TECHNICIAN_II = 'Laboratory Technician II';
    case LABORER_I = 'Laborer I';
    case LABORER_II = 'Laborer II';
    case LEGAL_ASSISTANT_II = 'Legal Assistant II';
    case LEGAL_ASSISTANT_III = 'Legal Assistant III';
    case LIBRARY_AIDE_I = 'Library Aide I';
    case MARKET_INSPECTOR_II = 'Market Inspector II';
    case MASON_II = 'Mason II';
    case MEDIA_PRODUCTION_ASSISTANT = 'Media Production Assistant';
    case MEDICAL_EQUIPMENT_TECHNICIAN_I = 'Medical Equipment Technician I';
    case MEDICAL_OFFICER_II = 'Medical Officer II';
    case MEDICAL_OFFICER_III = 'Medical Officer III';
    case MEDICAL_TECHNOLOGIST_I = 'Medical Technologist I';
    case NURSE_II = 'Nurse II';
    case NURSE_III = 'Nurse III';
    case ON_THE_JOB_TRAINING = 'On the Job Training';
    case PLANNING_OFFICER_I = 'Planning Officer I';
    case PLANNING_OFFICER_II = 'Planning Officer II';
    case PLANNING_OFFICER_III = 'Planning Officer III';
    case PROFESSOR_I = 'Professor I';
    case PROFESSOR_II = 'Professor II';
    case PROFESSOR_III = 'Professor III';
    case PROFESSOR_IV = 'Professor IV';
    case PROFESSOR_V = 'Professor V';
    case PROFESSOR_VI = 'Professor VI';
    case PROJECT_CLERK = 'Project Clerk';
    case PROJECT_DEVELOPMENT_OFFICER_I = 'Project Development Officer I';
    case PROJECT_DEVELOPMENT_OFFICER_II = 'Project Development Officer II';
    case PROJECT_DEVELOPMENT_OFFICER_III = 'Project Development Officer III';
    case PROJECT_LABORATORY_AIDE_I = 'Project Laboratory Aide I';
    case PROJECT_TECHNICAL_AIDE_VI = 'Project Technical Aide VI';
    case REGISTRAR_I = 'Registrar I';
    case REGISTRAR_II = 'Registrar II';
    case REGISTRAR_IV = 'Registrar IV';
    case SCHOOL_FARM_DEMONSTRATOR = 'School Farm Demonstrator';
    case SCHOOL_FARMING_COORDINATOR_I = 'School Farming Coordinator I';
    case SCIENCE_AIDE = 'Science Aide';
    case SCIENCE_RESEARCH_AIDE = 'Science Research Aide';
    case SCIENCE_RESEARCH_ANALYST = 'Science Research Analyst';
    case SCIENCE_RESEARCH_ASSISTANT = 'Science Research Assistant';
    case SCIENCE_RESEARCH_SPECIALIST_I = 'Science Research Specialist I';
    case SCIENCE_RESEARCH_SPECIALIST_II = 'Science Research Specialist II';
    case SECURITY_GUARD_I = 'Security Guard I';
    case SECURITY_GUARD_II = 'Security Guard II';
    case SENIOR_SCIENCE_RESEARCH_SPECIALIST = 'Senior Science Research Specialist';
    case SUC_PRESIDENT_IV = 'SUC President IV';
    case SUPERVISING_ADMINISTRATIVE_OFFICER = 'Supervising Administrative Officer';
    case TEST_TECHNICIAN_II = 'Test Technician II';
    case TRAINING_ASSISTANT = 'Training Assistant';
    case UNIVERSITY_RESEARCH_ASSOCIATE = 'University Research Associate';
    case UTILITY_WORKER_I = 'Utility Worker I';
    case VETERINARIAN_II = 'Veterinarian II';
    case VOCATIONAL_PLACEMENT_COORDINATOR_I = 'Vocational Placement Coordinator I';
    case WAITER_I = 'Waiter I';
    case WATCHMAN_I = 'Watchman I';
    case WATCHMAN_II = 'Watchman II';
    case YOUTH_DEVELOPMENT_ASSISTANT_II = 'Youth Development Assistant II';
}
