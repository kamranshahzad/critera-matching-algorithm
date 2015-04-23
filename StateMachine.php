<?php

	// Author : Kamran Shahzad
	// Author Email: bleak.unseen@gmail.com

	
	interface Filters{
		
		const LOCATION_RATIO 		= 0.3;
		const YEARS_RATIO			= 0.1;
		const EDUCATION_RATIO		= 0.1;
		const PROFESSIONALBG_RATIO	= 0.1;
		const INDUSTRY_RATIO		= 0.3;
		const PERSONALITY_RATIO		= 0.1;
		const DISTANCE_UNIT 		= 'mile';
		
		
		function setFilterValue($filterValue);
		function applyFilter();
		function disposePointer();
	}
	
	
	
	abstract class DefaultScore{
		
		private $distance;
		private $workExp;
		private $education;
		private $proBackground;
		private $industry;
		private $traits;
		
		public function __construct($_options=''){
			switch($_options){
				case 'location':
					$this->initDistance();break;
				case 'experince':
					$this->initWorkExperience();break;
				case 'education':
					$this->initEducation();break;
				case 'industry':
					$this->initIndustry();break;						
				case 'professtionalbg':
					$this->initProfessionBackground(); break;
				case 'traits':
					$this->initTraits();break;	
				default:
					 throw new Exception('Please sepecify option');
			}
		}
		
		private function initTraits(){
			$this->traits = array( array('candid','passive'),
								array('tactful','strategic'),
								array('charismatic','easygoing'),
								array('sarcastic','sincere'),
								array('versatile','efficientv'),
								array('efficientr','realistic'),
								array('transformative','harmonizing'),
								array('energetic','calm'),
								array('charming','humorous'),
								array('smart','wise')
							);
		}
		public function gettTraits(){
			return $this->traits;	
		}
		
		
		
		private function initDistance(){
			$this->distance = array(25=>1,50=>0.7, 150=>0.4, 200=>0.2);	
		}
		public function getDistance(){
			return $this->distance ;	
		}
		
		
		private function initWorkExperience(){
			$this->workExp = array(	'0-2year,0-2year' => 1 ,'0-2year,2-5year' => 0.6 ,'0-2year,5-10year' => 0.4 ,'0-2year,g10year' => 0.2 ,
									'2-5year,0-2year' => 0.6 ,'2-5year,2-5year' => 1 ,'2-5year,5-10year' => 0.5 ,'2-5year,g10year' => 0.4 ,
									'5-10year,0-2year' => 0.4 ,'5-10year,2-5year' => 0.5 ,'5-10year,5-10year' => 1 ,'5-10year,g10year' => 0.6 ,
									'g10year,0-2year' => 0.2 ,'g10year,2-5year' => 0.4 ,'g10year,5-10year' => 0.6 ,'g10year,g10year' => 1 
							);	
		}
		public function getWorkExp(){
			return $this->workExp;	
		}
		
		private function initEducation(){
			$this->education = array('highschool,highschool' => 1,'highschool,currentungraduate' => 0.2,'highschool,bachelors' => 0.1,'highschool,currentgraduate' => 0, 'highschool,graduatedegree' => 0,
									 'currentungraduate,highschool' => 0.2,'currentungraduate,currentungraduate' => 1,'currentungraduate,bachelors' => 0.6,'currentungraduate,currentgraduate' => 0.5,'currentungraduate,graduatedegree' => 0.3,
									 'bachelors,highschool' => 0.1,'bachelors,currentungraduate' => 0.6,'bachelors,bachelors' => 1, 'bachelors,currentgraduate' => 0.8,'bachelors,graduatedegree' => 0.6,
									 'currentgraduate,highschool' => 0,'currentgraduate,currentungraduate' => 0.5,'currentgraduate,bachelors' => 0.8,'currentgraduate,currentgraduate' => 1,'currentgraduate,graduatedegree' => 0.8,									 
									 'graduatedegree,highschool' => 0,'graduatedegree,currentungraduate' => 0.3,'graduatedegree,bachelors' => 0.6,'graduatedegree,currentgraduate' => 0.8,'graduatedegree,graduatedegree' => 1
									);	
		}
		public function getEducation(){
			return $this->education;	
		}
		
		private function initProfessionBackground(){
			$this->proBackground = array( 'sciences'=>array('animal_studies','anthropology','chemistry','computer_programming','computer_science','engineering','environmental_studies','geology','mathematics','physics','social_sciences','sociology') ,
										'arts'=>array('animation_&_digital_arts','architecture','dance','digital_communications_&_media','digital_imaging_&_design','graphic_design','history','literature','musician','painting_and_sculpting','philosophy','photography_and_imaging','publishing'),
										'business'=>array('accounting','economics','finance','human_resources','information_systems','insurance','management','marketing','operations_management','quality_assurance','real_estate_development','risk_management','sports_business_mgt','statistics','taxation'),
										'medical'=>array('dentistry','healthcare_management','medicine','mental_health','nursing','psychology'),
										'legal'=>array('law','paralegal'),
										'publicservices'=>array('armed_forces','fundraising','government','law_enforcement','ministry','philantrophy','politics','public_administration','public_relations'),
										'trades'=>array('baker-cook-chef','carpenter','clothing_design','construction','electrician','event_planning','florist','hairstylist-barber','health_&_beauty','internet_design','locksmith','machinist','manufacturing','mechanic','Painter_and_decorator','plumber','refrigeration-air_conditioning','roofer','security','teaching','technician','welder')
									);	
		}
		
		public function getProfessionalBackground(){
			return $this->proBackground;	
		}
		
		private function initIndustry(){
			$this->industry = array( 'accounting,accounting' => 1 ,  //#1
									'accounting,agriculture' => 0 ,
									'accounting,apparel' => 0 ,
									'accounting,banking' => 0.6 ,
									'accounting,chemicals' => 0 ,
									'accounting,communications' => 0 ,
									'accounting,construction' => 0.1 ,
									'accounting,consulting' => 0.5 ,
									'accounting,education' => 0.2 ,
									'accounting,energy' => 0.2 ,
									'accounting,engineering' => 0.4 ,
									'accounting,entertainment' => 0 ,
									'accounting,finance' => 0.7 ,
									'accounting,healthservices' => 0.1,
									'accounting,hotels' => 0 ,
									'accounting,insurance' => 0.2 ,
									'accounting,internet' => 0 ,
									'accounting,legalservices' => 0.1 ,
									'accounting,manufacturing' => 0.1 ,
									'accounting,membership' => 0 ,
									'accounting,music&motion' => 0 ,
									'accounting,publicadmin' => 0 ,
									'accounting,publishing' => 0 ,
									'accounting,realestate' => 0.1 ,
									'accounting,restuarants' => 0 ,
									'accounting,retail' => 0 ,
									'accounting,social&community' => 0 ,
									'accounting,technology' => 0.1 ,
									'accounting,transportation' => 0 ,
									
									'agriculture,accounting' => 0 ,  //#2
									'agriculture,agriculture' => 1 ,
									'agriculture,apparel' => 0 ,
									'agriculture,banking' =>0 ,
									'agriculture,chemicals' => 0.3 ,
									'agriculture,communications' => 0 ,
									'agriculture,construction' => 0.2 ,
									'agriculture,consulting' => 0 ,
									'agriculture,education' => 0.3 ,
									'agriculture,energy' => 0.3 ,
									'agriculture,engineering' => 0.1 ,
									'agriculture,entertainment' => 0 ,
									'agriculture,finance' => 0 ,
									'agriculture,healthservices' => 0.1,
									'agriculture,hotels' => 0 ,
									'agriculture,insurance' => 0 ,
									'agriculture,internet' => 0 ,
									'agriculture,legalservices' => 0 ,
									'agriculture,manufacturing' => 0.1 ,
									'agriculture,membership' => 0 ,
									'agriculture,music&motion' => 0 ,
									'agriculture,publicadmin' => 0.1 ,
									'agriculture,publishing' => 0 ,
									'agriculture,realestate' => 0.1 ,
									'agriculture,restuarants' => 0.1 ,
									'agriculture,retail' => 0 ,
									'agriculture,social&community' => 0 ,
									'agriculture,technology' => 0.1 ,
									'agriculture,transportation' => 0 ,
									
									'apparel,accounting' => 0 ,  //#3
									'apparel,agriculture' => 0 ,
									'apparel,apparel' => 1 ,
									'apparel,banking' => 0 ,
									'apparel,chemicals' => 0 ,
									'apparel,communications' => 0.1 ,
									'apparel,construction' => 0 ,
									'apparel,consulting' => 0 ,
									'apparel,education' => 0 ,
									'apparel,energy' => 0 ,
									'apparel,engineering' => 0 ,
									'apparel,entertainment' => 0 ,
									'apparel,finance' => 0 ,
									'apparel,healthservices' => 0,
									'apparel,hotels' => 0 ,
									'apparel,insurance' => 0 ,
									'apparel,internet' => 0 ,
									'apparel,legalservices' => 0 ,
									'apparel,manufacturing' => 0.2 ,
									'apparel,membership' => 0 ,
									'apparel,music&motion' => 0.1 ,
									'apparel,publicadmin' => 0 ,
									'apparel,publishing' => 0.1 ,
									'apparel,realestate' => 0 ,
									'apparel,restuarants' => 0 ,
									'apparel,retail' => 0.3 ,
									'apparel,social&community' => 0 ,
									'apparel,technology' => 0.1 ,
									'apparel,transportation' => 0 ,
									
									'banking,accounting' => 0.6 ,  //#4
									'banking,agriculture' => 0 ,
									'banking,apparel' => 0 ,
									'banking,banking' => 1 ,
									'banking,chemicals' => 0 ,
									'banking,communications' => 0.1 ,
									'banking,construction' => 0 ,
									'banking,consulting' => 0.3 ,
									'banking,education' => 0 ,
									'banking,energy' => 0.2 ,
									'banking,engineering' => 0 ,
									'banking,entertainment' => 0 ,
									'banking,finance' => 0.8 ,
									'banking,healthservices' => 0,
									'banking,hotels' => 0 ,
									'banking,insurance' => 0.2 ,
									'banking,internet' => 0 ,
									'banking,legalservices' => 0,
									'banking,manufacturing' => 0 ,
									'banking,membership' => 0 ,
									'banking,music&motion' => 0 ,
									'banking,publicadmin' => 0 ,
									'banking,publishing' => 0 ,
									'banking,realestate' => 0.4 ,
									'banking,restuarants' => 0 ,
									'banking,retail' => 0 ,
									'banking,social&community' => 0 ,
									'banking,technology' => 0 ,
									'banking,transportation' => 0 ,
									
									'chemicals,accounting' => 0 ,  //#5
									'chemicals,agriculture' => 0.3 ,
									'chemicals,apparel' => 0 ,
									'chemicals,banking' => 0 ,
									'chemicals,chemicals' => 1 ,
									'chemicals,communications' => 0 ,
									'chemicals,construction' => 0.2 ,
									'chemicals,consulting' => 0 ,
									'chemicals,education' => 0.2 ,
									'chemicals,energy' => 0.5 ,
									'chemicals,engineering' => 0.5 ,
									'chemicals,entertainment' => 0 ,
									'chemicals,finance' => 0 ,
									'chemicals,healthservices' => 0.1,
									'chemicals,hotels' => 0 ,
									'chemicals,insurance' => 0 ,
									'chemicals,internet' => 0 ,
									'chemicals,legalservices' => 0 ,
									'chemicals,manufacturing' => 0.2 ,
									'chemicals,membership' => 0 ,
									'chemicals,music&motion' => 0 ,
									'chemicals,publicadmin' => 0 ,
									'chemicals,publishing' => 0 ,
									'chemicals,realestate' => 0.1 ,
									'chemicals,restuarants' => 0 ,
									'chemicals,retail' => 0 ,
									'chemicals,social&community' => 0 ,
									'chemicals,technology' => 0 ,
									'chemicals,transportation' => 0.1 ,
									
									'communications,accounting' => 0 ,  //#6
									'communications,agriculture' => 0 ,
									'communications,apparel' => 0.1 ,
									'communications,banking' => 0.1 ,
									'communications,chemicals' => 0 ,
									'communications,communications' => 1 ,
									'communications,construction' => 0 ,
									'communications,consulting' => 0.1 ,
									'communications,education' => 0.1 ,
									'communications,energy' => 0 ,
									'communications,engineering' => 0 ,
									'communications,entertainment' => 0.3 ,
									'communications,finance' => 0 ,
									'communications,healthservices' => 0,
									'communications,hotels' => 0 ,
									'communications,insurance' => 0 ,
									'communications,internet' => 0.6 ,
									'communications,legalservices' => 0 ,
									'communications,manufacturing' => 0 ,
									'communications,membership' => 0.1 ,
									'communications,music&motion' => 0.1 ,
									'communications,publicadmin' => 0 ,
									'communications,publishing' => 0.5 ,
									'communications,realestate' => 0 ,
									'communications,restuarants' => 0 ,
									'communications,retail' => 0 ,
									'communications,social&community' => 0.1 ,
									'communications,technology' => 0.5 ,
									'communications,transportation' => 0 ,
									
									'construction,accounting' => 0.1 ,  //#7
									'construction,agriculture' => 0.2 ,
									'construction,apparel' => 0 ,
									'construction,banking' => 0 ,
									'construction,chemicals' => 0.2 ,
									'construction,communications' => 0 ,
									'construction,construction' => 1 ,
									'construction,consulting' => 0.1 ,
									'construction,education' => 0 ,
									'construction,energy' => 0.1 ,
									'construction,engineering' => 0.7 ,
									'construction,entertainment' => 0 ,
									'construction,finance' => 0 ,
									'construction,healthservices' => 0,
									'construction,hotels' => 0.2 ,
									'construction,insurance' => 0 ,
									'construction,internet' => 0 ,
									'construction,legalservices' => 0 ,
									'construction,manufacturing' => 0.2 ,
									'construction,membership' => 0 ,
									'construction,music&motion' => 0 ,
									'construction,publicadmin' => 0 ,
									'construction,publishing' => 0 ,
									'construction,realestate' => 0.4 ,
									'construction,restuarants' => 0.1 ,
									'construction,retail' => 0 ,
									'construction,social&community' => 0 ,
									'construction,technology' => 0 ,
									'construction,transportation' => 0 ,
									
									'consulting,accounting' => 0.5 ,  //#8
									'consulting,agriculture' => 0 ,
									'consulting,apparel' => 0 ,
									'consulting,banking' => 0.3 ,
									'consulting,chemicals' => 0 ,
									'consulting,communications' => 0.1 ,
									'consulting,construction' => 0.1 ,
									'consulting,consulting' => 1 ,
									'consulting,education' => 0.2 ,
									'consulting,energy' => 0 ,
									'consulting,engineering' => 0 ,
									'consulting,entertainment' => 0 ,
									'consulting,finance' => 0.5 ,
									'consulting,healthservices' => 0.1,
									'consulting,hotels' => 0 ,
									'consulting,insurance' => 0 ,
									'consulting,internet' => 0.2 ,
									'consulting,legalservices' => 0 ,
									'consulting,manufacturing' => 0 ,
									'consulting,membership' => 0.1 ,
									'consulting,music&motion' => 0 ,
									'consulting,publicadmin' => 0.1 ,
									'consulting,publishing' => 0 ,
									'consulting,realestate' => 0 ,
									'consulting,restuarants' => 0 ,
									'consulting,retail' => 0 ,
									'consulting,social&community' => 0 ,
									'consulting,technology' => 0 ,
									'consulting,transportation' => 0 ,
									
									'education,accounting' => 0.2 ,  //#9
									'education,agriculture' => 0.3 ,
									'education,apparel' => 0 ,
									'education,banking' => 0 ,
									'education,chemicals' => 0.2 ,
									'education,communications' => 0.1 ,
									'education,construction' => 0 ,
									'education,consulting' => 0.2 ,
									'education,education' => 1 ,
									'education,energy' => 0.1 ,
									'education,engineering' => 0.1 ,
									'education,entertainment' => 0 ,
									'education,finance' => 0.1 ,
									'education,healthservices' => 0.2,
									'education,hotels' => 0 ,
									'education,insurance' => 0 ,
									'education,internet' => 0 ,
									'education,legalservices' => 0 ,
									'education,manufacturing' => 0 ,
									'education,membership' => 0 ,
									'education,music&motion' => 0 ,
									'education,publicadmin' => 0.1 ,
									'education,publishing' => 0.3 ,
									'education,realestate' => 0 ,
									'education,restuarants' => 0 ,
									'education,retail' => 0 ,
									'education,social&community' => 0.1 ,
									'education,technology' => 0.2 ,
									'education,transportation' => 0 ,
									
									'energy,accounting' => 0.2 ,  //#10
									'energy,agriculture' => 0.3 ,
									'energy,apparel' => 0 ,
									'energy,banking' => 0.2 ,
									'energy,chemicals' => 0.5 ,
									'energy,communications' => 0 ,
									'energy,construction' => 0.1 ,
									'energy,consulting' => 0 ,
									'energy,education' => 0.1 ,
									'energy,energy' => 1,
									'energy,engineering' => 0.6 ,
									'energy,entertainment' => 0 ,
									'energy,finance' => 0.2 ,
									'energy,healthservices' => 0,
									'energy,hotels' => 0 ,
									'energy,insurance' => 0 ,
									'energy,internet' => 0 ,
									'energy,legalservices' => 0 ,
									'energy,manufacturing' => 0.1 ,
									'energy,membership' => 0 ,
									'energy,music&motion' => 0 ,
									'energy,publicadmin' => 0.1 ,
									'energy,publishing' => 0 ,
									'energy,realestate' => 0 ,
									'energy,restuarants' => 0 ,
									'energy,retail' => 0 ,
									'energy,social&community' => 0 ,
									'energy,technology' => 0.2 ,
									'energy,transportation' => 0.7 ,
									
									'engineering,accounting' => 0.4 ,  //#11
									'engineering,agriculture' => 0.1 ,
									'engineering,apparel' => 0 ,
									'engineering,banking' => 0 ,
									'engineering,chemicals' => 0.5 ,
									'engineering,communications' => 0 ,
									'engineering,construction' => 0.7 ,
									'engineering,consulting' => 0 ,
									'engineering,education' => 0.1 ,
									'engineering,energy' => 0.6 ,
									'engineering,engineering' => 1 ,
									'engineering,entertainment' => 0 ,
									'engineering,finance' => 0.1 ,
									'engineering,healthservices' => 0.1,
									'engineering,hotels' => 0 ,
									'engineering,insurance' => 0 ,
									'engineering,internet' => 0.1 ,
									'engineering,legalservices' => 0 ,
									'engineering,manufacturing' => 0.6 ,
									'engineering,membership' => 0 ,
									'engineering,music&motion' => 0 ,
									'engineering,publicadmin' => 0 ,
									'engineering,publishing' => 0.1 ,
									'engineering,realestate' => 0 ,
									'engineering,restuarants' => 0 ,
									'engineering,retail' => 0 ,
									'engineering,social&community' => 0 ,
									'engineering,technology' => 0.4 ,
									'engineering,transportation' => 0.2 ,
									
									'entertainment,accounting' => 0 ,  //#12
									'entertainment,agriculture' => 0 ,
									'entertainment,apparel' => 0 ,
									'entertainment,banking' => 0 ,
									'entertainment,chemicals' => 0 ,
									'entertainment,communications' => 0.3 ,
									'entertainment,construction' => 0 ,
									'entertainment,consulting' => 0 ,
									'entertainment,education' => 0 ,
									'entertainment,energy' => 0 ,
									'entertainment,engineering' => 0 ,
									'entertainment,entertainment' => 1 ,
									'entertainment,finance' => 0 ,
									'entertainment,healthservices' => 0,
									'entertainment,hotels' => 0 ,
									'entertainment,insurance' => 0 ,
									'entertainment,internet' => 0.2 ,
									'entertainment,legalservices' => 0 ,
									'entertainment,manufacturing' => 0 ,
									'entertainment,membership' => 0 ,
									'entertainment,music&motion' => 0.7 ,
									'entertainment,publicadmin' => 0 ,
									'entertainment,publishing' => 0.3 ,
									'entertainment,realestate' => 0 ,
									'entertainment,restuarants' => 0 ,
									'entertainment,retail' => 0 ,
									'entertainment,social&community' => 0 ,
									'entertainment,technology' => 0 ,
									'entertainment,transportation' => 0 ,
									
									'finance,accounting' => 0.7 ,  //#13
									'finance,agriculture' => 0 ,
									'finance,apparel' => 0 ,
									'finance,banking' => 0.8 ,
									'finance,chemicals' => 0 ,
									'finance,communications' => 0 ,
									'finance,construction' => 0 ,
									'finance,consulting' => 0.5 ,
									'finance,education' => 0.1 ,
									'finance,energy' => 0.2 ,
									'finance,engineering' => 0.1 ,
									'finance,entertainment' => 0 ,
									'finance,finance' => 1 ,
									'finance,healthservices' => 0,
									'finance,hotels' => 0 ,
									'finance,insurance' => 0.3 ,
									'finance,internet' => 0 ,
									'finance,legalservices' => 0 ,
									'finance,manufacturing' => 0 ,
									'finance,membership' => 0.1 ,
									'finance,music&motion' => 0 ,
									'finance,publicadmin' => 0.1 ,
									'finance,publishing' => 0 ,
									'finance,realestate' => 0.5 ,
									'finance,restuarants' => 0 ,
									'finance,retail' => 0 ,
									'finance,social&community' => 0 ,
									'finance,technology' => 0 ,
									'finance,transportation' => 0 ,
									
									'healthservices,accounting' => 0.1 ,  //#14
									'healthservices,agriculture' => 0.1 ,
									'healthservices,apparel' => 0 ,
									'healthservices,banking' => 0 ,
									'healthservices,chemicals' => 0.1 ,
									'healthservices,communications' => 0 ,
									'healthservices,construction' => 0 ,
									'healthservices,consulting' => 0.1 ,
									'healthservices,education' => 0.2 ,
									'healthservices,energy' => 0 ,
									'healthservices,engineering' => 0.1 ,
									'healthservices,entertainment' => 0 ,
									'healthservices,finance' => 0 ,
									'healthservices,healthservices' => 1,
									'healthservices,hotels' => 0.1 ,
									'healthservices,insurance' => 0.4 ,
									'healthservices,internet' => 0 ,
									'healthservices,legalservices' => 0 ,
									'healthservices,manufacturing' => 0 ,
									'healthservices,membership' => 0.1 ,
									'healthservices,music&motion' => 0 ,
									'healthservices,publicadmin' => 0.2 ,
									'healthservices,publishing' => 0 ,
									'healthservices,realestate' => 0 ,
									'healthservices,restuarants' => 0 ,
									'healthservices,retail' => 0 ,
									'healthservices,social&community' => 0.3 ,
									'healthservices,technology' => 0.1 ,
									'healthservices,transportation' => 0 ,
									
									'hotels,accounting' => 0 ,  //#15
									'hotels,agriculture' => 0 ,
									'hotels,apparel' => 0 ,
									'hotels,banking' => 0 ,
									'hotels,chemicals' => 0 ,
									'hotels,communications' => 0 ,
									'hotels,construction' => 0.2 ,
									'hotels,consulting' => 0 ,
									'hotels,education' => 0 ,
									'hotels,energy' => 0 ,
									'hotels,engineering' => 0 ,
									'hotels,entertainment' => 0 ,
									'hotels,finance' => 0 ,
									'hotels,healthservices' => 0.1,
									'hotels,hotels' => 1 ,
									'hotels,insurance' => 0 ,
									'hotels,internet' => 0 ,
									'hotels,legalservices' => 0 ,
									'hotels,manufacturing' => 0 ,
									'hotels,membership' => 0.1 ,
									'hotels,music&motion' => 0 ,
									'hotels,publicadmin' => 0 ,
									'hotels,publishing' => 0 ,
									'hotels,realestate' => 0.3 ,
									'hotels,restuarants' => 0.2 ,
									'hotels,retail' => 0.1 ,
									'hotels,social&community' => 0 ,
									'hotels,technology' => 0 ,
									'hotels,transportation' => 0.1 ,
									
									'insurance,accounting' => 0.2 ,  //#16
									'insurance,agriculture' => 0 ,
									'insurance,apparel' => 0 ,
									'insurance,banking' => 0.2 ,
									'insurance,chemicals' => 0 ,
									'insurance,communications' => 0 ,
									'insurance,construction' => 0 ,
									'insurance,consulting' => 0 ,
									'insurance,education' => 0 ,
									'insurance,energy' => 0 ,
									'insurance,engineering' => 0 ,
									'insurance,entertainment' => 0 ,
									'insurance,finance' => 0.3 ,
									'insurance,healthservices' => 0.4,
									'insurance,hotels' => 0 ,
									'insurance,insurance' => 1 ,
									'insurance,internet' => 0 ,
									'insurance,legalservices' => 0.2 ,
									'accounting,manufacturing' => 0.1 ,
									'insurance,membership' => 0.1 ,
									'insurance,music&motion' => 0 ,
									'insurance,publicadmin' => 0 ,
									'insurance,publishing' => 0 ,
									'insurance,realestate' => 0.1 ,
									'insurance,restuarants' => 0 ,
									'insurance,retail' => 0 ,
									'insurance,social&community' => 0.2 ,
									'insurance,technology' => 0 ,
									'insurance,transportation' => 0.1 ,
									
									'internet,accounting' => 0 ,  //#17
									'internet,agriculture' => 0 ,
									'internet,apparel' => 0 ,
									'internet,banking' => 0 ,
									'internet,chemicals' => 0 ,
									'internet,communications' => 0.6 ,
									'internet,construction' => 0 ,
									'internet,consulting' => 0.2 ,
									'internet,education' => 0 ,
									'internet,energy' => 0 ,
									'internet,engineering' => 0.1 ,
									'internet,entertainment' => 0.2 ,
									'internet,finance' => 0 ,
									'internet,healthservices' => 0,
									'internet,hotels' => 0 ,
									'internet,insurance' => 0 ,
									'internet,internet' => 1 ,
									'internet,legalservices' => 0 ,
									'internet,manufacturing' => 0 ,
									'internet,membership' => 0.1 ,
									'internet,music&motion' => 0.1 ,
									'internet,publicadmin' => 0 ,
									'internet,publishing' => 0.4 ,
									'internet,realestate' => 0 ,
									'internet,restuarants' => 0 ,
									'internet,retail' => 0.2 ,
									'internet,social&community' => 0 ,
									'internet,technology' => 0.6 ,
									'internet,transportation' => 0 ,
									
									'legalservices,accounting' => 0.1 ,  //#18
									'legalservices,agriculture' => 0 ,
									'legalservices,apparel' => 0 ,
									'legalservices,banking' => 0 ,
									'legalservices,chemicals' => 0 ,
									'legalservices,communications' => 0 ,
									'legalservices,construction' => 0 ,
									'legalservices,consulting' => 0 ,
									'legalservices,education' => 0 ,
									'legalservices,energy' => 0 ,
									'legalservices,engineering' => 0 ,
									'legalservices,entertainment' => 0 ,
									'legalservices,finance' => 0 ,
									'legalservices,healthservices' => 0,
									'legalservices,hotels' => 0 ,
									'legalservices,insurance' => 0.2 ,
									'legalservices,internet' => 0 ,
									'legalservices,legalservices' => 1 ,
									'legalservices,manufacturing' => 0 ,
									'legalservices,membership' => 0.1 ,
									'legalservices,music&motion' => 0 ,
									'legalservices,publicadmin' => 0 ,
									'legalservices,publishing' => 0.1 ,
									'legalservices,realestate' => 0 ,
									'legalservices,restuarants' => 0 ,
									'legalservices,retail' => 0 ,
									'legalservices,social&community' => 0.1 ,
									'legalservices,technology' => 0 ,
									'legalservices,transportation' => 0 ,
									
									'manufacturing,accounting' => 0.1 ,  //#19
									'manufacturing,agriculture' => 0.1 ,
									'manufacturing,apparel' => 0.2 ,
									'manufacturing,banking' => 0 ,
									'manufacturing,chemicals' => 0.2 ,
									'manufacturing,communications' => 0 ,
									'manufacturing,construction' => 0.2 ,
									'manufacturing,consulting' => 0 ,
									'manufacturing,education' => 0 ,
									'manufacturing,energy' => 0.1 ,
									'manufacturing,engineering' => 0.6 ,
									'manufacturing,entertainment' => 0 ,
									'manufacturing,finance' => 0 ,
									'manufacturing,healthservices' => 0,
									'manufacturing,hotels' => 0 ,
									'manufacturing,insurance' => 0.1 ,
									'manufacturing,internet' => 0 ,
									'manufacturing,legalservices' => 0 ,
									'manufacturing,manufacturing' => 1 ,
									'manufacturing,membership' => 0 ,
									'manufacturing,music&motion' => 0 ,
									'manufacturing,publicadmin' => 0 ,
									'manufacturing,publishing' => 0.1 ,
									'manufacturing,realestate' => 0.1 ,
									'manufacturing,restuarants' => 0 ,
									'manufacturing,retail' => 0.1 ,
									'manufacturing,social&community' => 0 ,
									'manufacturing,technology' => 0.3 ,
									'manufacturing,transportation' => 0.1 ,
									
									'membership,accounting' => 0 ,  //#20
									'membership,agriculture' => 0 ,
									'membership,apparel' => 0 ,
									'membership,banking' => 0,
									'membership,chemicals' => 0 ,
									'membership,communications' => 0.1 ,
									'membership,construction' => 0 ,
									'membership,consulting' => 0.1 ,
									'membership,education' => 0 ,
									'membership,energy' => 0 ,
									'membership,engineering' => 0 ,
									'membership,entertainment' => 0 ,
									'membership,finance' => 0.1 ,
									'membership,healthservices' => 0.1,
									'membership,hotels' => 0.1 ,
									'membership,insurance' => 0.1 ,
									'membership,internet' => 0.1 ,
									'membership,legalservices' => 0.1 ,
									'membership,manufacturing' => 0 ,
									'membership,membership' => 1 ,
									'membership,music&motion' => 0 ,
									'membership,publicadmin' => 0.1 ,
									'membership,publishing' => 0.1 ,
									'membership,realestate' => 0 ,
									'membership,restuarants' => 0 ,
									'membership,retail' => 0.1 ,
									'membership,social&community' => 0.2 ,
									'membership,technology' => 0 ,
									'membership,transportation' => 0 ,
									
									'music&motion,accounting' => 0 ,  //#21
									'music&motion,agriculture' => 0 ,
									'music&motion,apparel' => 0.1 ,
									'music&motion,banking' => 0 ,
									'music&motion,chemicals' => 0 ,
									'music&motion,communications' => 0.1 ,
									'music&motion,construction' => 0 ,
									'music&motion,consulting' => 0 ,
									'music&motion,education' => 0 ,
									'music&motion,energy' => 0 ,
									'music&motion,engineering' => 0 ,
									'music&motion,entertainment' => 0.7 ,
									'music&motion,finance' => 0 ,
									'music&motion,healthservices' => 0,
									'music&motion,hotels' => 0 ,
									'music&motion,insurance' => 0 ,
									'music&motion,internet' => 0.1 ,
									'music&motion,legalservices' => 0 ,
									'music&motion,manufacturing' => 0 ,
									'music&motion,membership' => 0 ,
									'music&motion,music&motion' => 1 ,
									'music&motion,publicadmin' => 0 ,
									'music&motion,publishing' => 0.3 ,
									'music&motion,realestate' => 0 ,
									'music&motion,restuarants' => 0 ,
									'music&motion,retail' => 0.1 ,
									'music&motion,social&community' => 0 ,
									'music&motion,technology' => 0.1 ,
									'music&motion,transportation' => 0.1 ,
									
									'publicadmin,accounting' => 0 ,  //#22
									'publicadmin,agriculture' => 0.1 ,
									'publicadmin,apparel' => 0 ,
									'publicadmin,banking' => 0 ,
									'publicadmin,chemicals' => 0 ,
									'publicadmin,communications' => 0 ,
									'publicadmin,construction' => 0 ,
									'publicadmin,consulting' => 0.1 ,
									'publicadmin,education' => 0.1 ,
									'publicadmin,energy' => 0.1 ,
									'publicadmin,engineering' => 0 ,
									'publicadmin,entertainment' => 0 ,
									'publicadmin,finance' => 0.1 ,
									'publicadmin,healthservices' => 0.2,
									'publicadmin,hotels' => 0 ,
									'publicadmin,insurance' => 0 ,
									'publicadmin,internet' => 0 ,
									'publicadmin,legalservices' => 0 ,
									'publicadmin,manufacturing' => 0 ,
									'publicadmin,membership' => 0.1 ,
									'publicadmin,music&motion' => 0 ,
									'publicadmin,publicadmin' => 1 ,
									'publicadmin,publishing' => 0 ,
									'publicadmin,realestate' => 0 ,
									'publicadmin,restuarants' => 0 ,
									'publicadmin,retail' => 0 ,
									'publicadmin,social&community' => 0.6 ,
									'publicadmin,technology' => 0 ,
									'publicadmin,transportation' => 0.1 ,
									
									'publishing,accounting' => 0 ,  //#23
									'publishing,agriculture' => 0 ,
									'publishing,apparel' => 0.1 ,
									'publishing,banking' => 0 ,
									'publishing,chemicals' => 0 ,
									'publishing,communications' => 0.5 ,
									'publishing,construction' => 0 ,
									'publishing,consulting' => 0 ,
									'publishing,education' => 0.3 ,
									'publishing,energy' => 0 ,
									'publishing,engineering' => 0.1 ,
									'publishing,entertainment' => 0.3 ,
									'publishing,finance' => 0 ,
									'publishing,healthservices' => 0,
									'publishing,hotels' => 0 ,
									'publishing,insurance' => 0 ,
									'publishing,internet' => 0.4 ,
									'publishing,legalservices' => 0.1 ,
									'publishing,manufacturing' => 0.1 ,
									'publishing,membership' => 0.1 ,
									'publishing,music&motion' => 0.3 ,
									'publishing,publicadmin' => 0 ,
									'publishing,publishing' => 1 ,
									'publishing,realestate' => 0 ,
									'publishing,restuarants' => 0 ,
									'publishing,retail' => 0 ,
									'publishing,social&community' => 0 ,
									'publishing,technology' => 0 ,
									'publishing,transportation' => 0 ,
									
									'realestate,accounting' => 0.1 ,  //#24
									'realestate,agriculture' => 0.1 ,
									'realestate,apparel' => 0 ,
									'realestate,banking' => 0.4 ,
									'realestate,chemicals' => 0.1 ,
									'realestate,communications' => 0 ,
									'realestate,construction' => 0.4 ,
									'realestate,consulting' => 0 ,
									'realestate,education' => 0 ,
									'realestate,energy' => 0 ,
									'realestate,engineering' => 0 ,
									'realestate,entertainment' => 0 ,
									'realestate,finance' => 0.5 ,
									'realestate,healthservices' => 0,
									'realestate,hotels' => 0.3 ,
									'realestate,insurance' => 0.1 ,
									'realestate,internet' => 0 ,
									'realestate,legalservices' => 0 ,
									'realestate,manufacturing' => 0.1 ,
									'realestate,membership' => 0 ,
									'realestate,music&motion' => 0 ,
									'realestate,publicadmin' => 0 ,
									'realestate,publishing' => 0 ,
									'realestate,realestate' => 1 ,
									'realestate,restuarants' => 0.1 ,
									'realestate,retail' => 0.4 ,
									'realestate,social&community' => 0 ,
									'realestate,technology' => 0 ,
									'realestate,transportation' => 0 ,
									
									'restuarants,accounting' => 0 ,  //#25
									'restuarants,agriculture' => 0.1 ,
									'restuarants,apparel' => 0 ,
									'restuarants,banking' => 0 ,
									'restuarants,chemicals' => 0 ,
									'restuarants,communications' => 0 ,
									'restuarants,construction' => 0.1 ,
									'restuarants,consulting' => 0 ,
									'restuarants,education' => 0 ,
									'restuarants,energy' => 0 ,
									'restuarants,engineering' => 0 ,
									'restuarants,entertainment' => 0 ,
									'restuarants,finance' => 0 ,
									'restuarants,healthservices' => 0,
									'restuarants,hotels' => 0.2 ,
									'restuarants,insurance' => 0 ,
									'restuarants,internet' => 0 ,
									'restuarants,legalservices' => 0 ,
									'restuarants,manufacturing' => 0 ,
									'restuarants,membership' => 0 ,
									'restuarants,music&motion' => 0 ,
									'restuarants,publicadmin' => 0 ,
									'restuarants,publishing' => 0 ,
									'restuarants,realestate' => 0.1 ,
									'restuarants,restuarants' => 1 ,
									'restuarants,retail' => 0.4 ,
									'restuarants,social&community' => 0 ,
									'restuarants,technology' => 0 ,
									'restuarants,transportation' => 0.1 ,
									
									'retail,accounting' => 0 ,  //#26
									'retail,agriculture' => 0 ,
									'retail,apparel' => 0.3 ,
									'retail,banking' => 0 ,
									'retail,chemicals' => 0 ,
									'retail,communications' => 0 ,
									'retail,construction' => 0 ,
									'retail,consulting' => 0 ,
									'retail,education' => 0 ,
									'retail,energy' => 0 ,
									'retail,engineering' => 0 ,
									'retail,entertainment' => 0 ,
									'retail,finance' => 0 ,
									'retail,healthservices' => 0,
									'retail,hotels' => 0.1 ,
									'retail,insurance' => 0 ,
									'retail,internet' => 0.2 ,
									'retail,legalservices' => 0 ,
									'retail,manufacturing' => 0.1 ,
									'retail,membership' => 0.1 ,
									'retail,music&motion' => 0.1 ,
									'retail,publicadmin' => 0 ,
									'retail,publishing' => 0 ,
									'retail,realestate' => 0.4 ,
									'retail,restuarants' => 0.4 ,
									'retail,retail' => 1 ,
									'retail,social&community' => 0 ,
									'retail,technology' => 0 ,
									'retail,transportation' => 0 ,
									
									'social&community,accounting' => 0 ,  //#27
									'social&community,agriculture' => 0 ,
									'social&community,apparel' => 0 ,
									'social&community,banking' => 0 ,
									'social&community,chemicals' => 0 ,
									'social&community,communications' => 0.1 ,
									'social&community,construction' => 0 ,
									'social&community,consulting' => 0 ,
									'social&community,education' => 0.1 ,
									'social&community,energy' => 0 ,
									'social&community,engineering' => 0 ,
									'social&community,entertainment' => 0 ,
									'social&community,finance' => 0 ,
									'social&community,healthservices' => 0.3,
									'social&community,hotels' => 0 ,
									'social&community,insurance' => 0.2 ,
									'social&community,internet' => 0 ,
									'social&community,legalservices' => 0.1 ,
									'social&community,manufacturing' => 0 ,
									'social&community,membership' => 0.2 ,
									'social&community,music&motion' => 0 ,
									'social&community,publicadmin' => 0.6 ,
									'social&community,publishing' => 0 ,
									'social&community,realestate' => 0 ,
									'social&community,restuarants' => 0 ,
									'social&community,retail' => 0 ,
									'social&community,social&community' => 1 ,
									'social&community,technology' => 0 ,
									'social&community,transportation' => 0 ,
									
									'technology,accounting' => 0.1 ,  //#28
									'technology,agriculture' => 0.1 ,
									'technology,apparel' => 0.1 ,
									'technology,banking' => 0 ,
									'technology,chemicals' => 0 ,
									'technology,communications' => 0.5 ,
									'technology,construction' => 0 ,
									'technology,consulting' => 0 ,
									'technology,education' => 0.2 ,
									'technology,energy' => 0.2 ,
									'technology,engineering' => 0.4 ,
									'technology,entertainment' => 0 ,
									'technology,finance' => 0 ,
									'technology,healthservices' => 0.1,
									'technology,hotels' => 0 ,
									'technology,insurance' => 0 ,
									'technology,internet' => 0.6 ,
									'technology,legalservices' => 0 ,
									'technology,manufacturing' => 0.3 ,
									'technology,membership' => 0 ,
									'technology,music&motion' => 0.1 ,
									'technology,publicadmin' => 0 ,
									'technology,publishing' => 0 ,
									'technology,realestate' => 0 ,
									'technology,restuarants' => 0 ,
									'technology,retail' => 0 ,
									'technology,social&community' => 0 ,
									'technology,technology' => 1 ,
									'technology,transportation' => 0.3 ,
									
									'transportation,accounting' => 0 ,  //#29
									'transportation,agriculture' => 0 ,
									'transportation,apparel' => 0 ,
									'transportation,banking' => 0 ,
									'transportation,chemicals' => 0.1 ,
									'transportation,communications' => 0 ,
									'transportation,construction' => 0 ,
									'transportation,consulting' => 0 ,
									'transportation,education' => 0 ,
									'transportation,energy' => 0.7 ,
									'transportation,engineering' => 0.2 ,
									'transportation,entertainment' => 0 ,
									'transportation,finance' => 0 ,
									'transportation,healthservices' => 0,
									'transportation,hotels' => 0.1 ,
									'transportation,insurance' => 0.1 ,
									'transportation,internet' => 0 ,
									'transportation,legalservices' => 0 ,
									'transportation,manufacturing' => 0.1 ,
									'transportation,membership' => 0 ,
									'transportation,music&motion' => 0.1 ,
									'transportation,publicadmin' => 0.1 ,
									'transportation,publishing' => 0 ,
									'transportation,realestate' => 0 ,
									'transportation,restuarants' => 0.1 ,
									'transportation,retail' => 0 ,
									'transportation,social&community' => 0 ,
									'transportation,technology' => 0.3 ,
									'transportation,transportation' => 1 ,
									);	
		}
		public function getIndustry(){
			return $this->industry;
		}
		
		
			
	} //@
	
	
	
	
	
	
	
	/*
		@ Experince
		@ status : (done)
		******************************************************************************
	*/
	
	class ExperinceFilter extends DefaultScore implements Filters{
		
		private $dataHashtable;
		private $filterKeyValue;
		private $filterValue;
		private $score	= 0;
		
		public function __construct(){
			parent::__construct('experince');
			$this->dataHashtable =  $this->getWorkExp();
		}
		
		public function setFilterKey($_filterKey ){
			if(!empty($_filterKey))
				$this->filterKeyValue = $_filterKey;
		}
		
		public function setFilterValue( $_filterValue ){
			if(!empty($_filterValue))
				$this->filterValue = $_filterValue;
			else
				throw new Exception("Empty Values found in Traits.");
		}
		
		public function applyFilter(){
			$searchVal = $this->filterKeyValue.','.$this->filterValue;
			if(array_key_exists($searchVal , $this->dataHashtable)){
				$this->score = $this->dataHashtable[$searchVal];
			}
		}
		
		public function getFilterScore(){
			$this->applyFilter();
			$score = $this->score* self::YEARS_RATIO;
			$this->disposePointer();
			return $score;
		}
		
		public function disposePointer(){
			$this->score	= 0;
			$this->filterValue	= '';
		}
		
		
	} //@
	
	/*
		@ how to use
		$obj = new ExperinceFilter();
		$obj->setFilterKey('2-5year');
		$values = array('5-10year','2-5year','0-2year');
		foreach($values as $val){
			$obj->setFilterValue($val);
			echo($obj->getFilterScore().'<br/>');
		}
	*/
	
	
	
	/*
		@ Education
		@ status : (done)
		******************************************************************************
	*/
	class EducationFilter extends DefaultScore implements Filters{
		
		private $dataHashtable;
		private $filterKeyValue;
		private $filterValue;
		private $score	= 0;
		
		public function __construct(){
			parent::__construct('education');
			$this->dataHashtable =  $this->getEducation();
		}
		
		public function setFilterKey($_filterKey ){
			if(!empty($_filterKey))
				$this->filterKeyValue = $_filterKey;
		}
		
		public function setFilterValue( $_filterValue ){
			if(!empty($_filterValue))
				$this->filterValue = $_filterValue;
			else
				throw new Exception("Empty Values found in Traits.");
		}
		
		public function applyFilter(){
			$searchVal = $this->filterKeyValue.','.$this->filterValue;
			if(array_key_exists($searchVal , $this->dataHashtable)){
				$this->score = $this->dataHashtable[$searchVal];
			}
		}
		
		public function getFilterScore(){
			$this->applyFilter();
			$score = $this->score* self::EDUCATION_RATIO;
			$this->disposePointer();
			return $score;
		}
		
		public function disposePointer(){
			$this->score	= 0;
			$this->filterValue	= '';
		}
	} //@
	
	
	
	
	
	/*
		@ Traits
		@ status : (done)
		******************************************************************************
	*/
	
	class TraitsFilter extends DefaultScore implements Filters{
		
		private $dataHashtable;
		private $filterValueArr;
		private $howMany = 0;
		
		public function __construct(){
			parent::__construct('traits');
			$this->dataHashtable =  $this->gettTraits();
		}
			
		public function setFilterValue( $_filterValue ){
			if(!empty($_filterValue))
				$this->filterValueArr = explode(',',$_filterValue);
			else
				throw new Exception("Empty Values found in Traits.");
		}
		
		public function applyFilter(){
			foreach($this->dataHashtable as $group){
				foreach($group as $child){
					if(in_array( $child , $this->filterValueArr)){
						$this->howMany+=0.1;
					}
				}
			}
		}
		
		public function getFilterScore(){
			$this->applyFilter();
			$score = $this->howMany;
			$this->disposePointer();
			return $score;	
		}
		
		public function disposePointer(){
			$this->howMany = 0;
			$this->filterValueArr = array();
		}
			
		
	} //@
	
	/*
		@how to use
		$keyTraitsArr = "sincere,efficientv,realistic";
		
		$obj = new TraitsFilter();
		$obj->setFilterValues($keyTraitsArr);
		$obj->applyFilter();
		echo($obj->getTraits());
	*/
	
	
	
	/*
		@ professional backgrounds  
		@ status : (done)
		******************************************************************************
	*/
	class ProBackgroundFilter extends DefaultScore implements Filters{
		
		private $filterKeyArr;
		private $keyGroupArr;
		private $filterValueArr;
		private $dataHashtable;
		private $howMany = 0;
		
		public function __construct($_filterKey){
			parent::__construct();
			$this->dataHashtable = $this->getProfessionalBackground();
			$this->hashArray 	  = array();
			$this->filterValueArr = array();
			if(!empty($_filterKey)){
				$this->filterKeyArr = explode(',',$_filterKey);
				$this->keyGroupArr  = $this->keyGroups($this->filterKeyArr);
			}else{
				throw Exception("Invalid data");
			}
		}
		
		public function setFilterValue( $_filterValue ){
			$this->filterValueArr = explode(',',$_filterValue);
		}
		
		public function applyFilter(){
			foreach($this->filterValueArr as $val){
				if(in_array($val, $this->filterKeyArr )){
					$this->howMany = 1;
				}else{
					$this->checkInGroups($val);	
				}
			}
		}
		
		public function getScore(){
			$output = $this->howMany;
			$this->disposePointer();
			return $output;
		}
		
		private function checkInGroups($needle){
			foreach($this->keyGroupArr as $val){
				if(in_array($needle , $this->dataHashtable[$val])){
					$this->howMany += 0.1;
				}
			}
		}
		
		
		private function keyGroups($valueArr){
			$foundGroups = array();
			foreach($this->dataHashtable as $group=>$groupArr){
				if(count(array_intersect( $valueArr , $groupArr)) > 0){
						$foundGroups[] = $group; 
				}
			}
			return $foundGroups;
		}
		
		public function disposePointer(){
			$this->howMany        	= 0;
			$this->hashArray 	  	= array();
			$this->filterValueArr 	= array();
		}
	
	} //@
	
	/*
		@ how to use
		$desireBackground = "animation_and_digital_arts,cinema,graphic_design";
		$probgroundUsers = array(3=>'dance,digital_imaging_&_design,photography_and_imaging',4=>'nursing,government,politics',5=>'plumber,fundraising,graphic_design');
		$pbObj = new ProBackgroundFilter($desireBackground);
	
		
		foreach($probgroundUsers as $uid=>$value){
			$pbObj->setFilterValues($value);
			$pbObj->applyFilter();
			echo('Userid=>'.$uid.'  '.$pbObj->getScore()."<br/>");
		}
	*/
	
	
	
	/*
		@ locations (distance etc)
		@ status : (in process)
		******************************************************************************
	*/
	
	class DistanceFilter extends DefaultScore  implements Filters{
		
		private $dataHashtable;
		private $filterKeyValue;
		private $filterValue;
		private $score	= 0;
		
		public function __construct(){
			parent::__construct('location');
			$this->dataHashtable = $this->getDistance();
		}
		
		public function setFilterKey($_filterKey ){
			if(!empty($_filterKey))
				$this->filterKeyValue = explode(',',$_filterKey);
			else
				throw new Exception("Empty Values found in Distance.");
		}
		
		public function setFilterValue( $_filterValue ){
			if(!empty($_filterValue))
				$this->filterValue = explode(',',$_filterValue);
			else
				throw new Exception("Empty Values found in Distance.");
		}
		
		public function applyFilter(){
			$distance = $this->calculateDistance();
			foreach($this->dataHashtable as $distanceRange => $assignScore){
				if($distance <= $distanceRange){
					$this->score = $assignScore;
					break;	
				}
			}
			if($this->score == 0){
				$this->score = end($this->dataHashtable);	
			}
		}
		
		public function getFilterScore(){
			$score = 0;
			$this->applyFilter();
			$score = $this->score* self::LOCATION_RATIO;
			$this->disposePointer();
			return $score;	
		}
		
		
		private function calculateDistance(){
			
			$lat1 = $lon1 = $lat2 = $lon2 = 0;
			if(array_key_exists( 0 , $this->filterKeyValue)){
				$lat1 = $this->filterKeyValue[0];	
			}
			if(array_key_exists( 1 , $this->filterKeyValue)){
				$lon1 = $this->filterKeyValue[1];	
			}
			if(array_key_exists( 0 , $this->filterValue)){
				$lat2 = $this->filterValue[0];	
			}
			if(array_key_exists( 1 , $this->filterValue)){
				$lon2 = $this->filterValue[1];	
			}			
			
			$theta = $lon1 - $lon2; 
  			$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
  			$dist = acos($dist); 
 		    $dist = rad2deg($dist); 
  			$miles = $dist * 60 * 1.1515;
			return $miles;
		}
		
		public function disposePointer(){
			$this->filterValue	= array();
			$this->score = 0;
		}
		
		
		
	} //@
	
	/*
		@ how to use
		$obj = new DistanceFilter();
		$obj->setFilterKey('32.9697,-96.80322');
		$data = array('32.99997,-96.80506','32.35997,-96.80506' ,'32.31997,-96.80506','31.31997,-96.80506', '28.31997,-96.80506', '22.31997,-96.80506');
		foreach($data as $val){
			$obj->setFilterValue($val);
			echo($obj->getFilterScore().'<br/>');	
		}
	*/
	

	
	
	/*
		@ Industry
		@ status : (in process)
		******************************************************************************
	*/
	
	
	class IndustryFilter extends DefaultScore{
		
		private $filterKeyArr;
		private $uid = 0;
		private $maxValue = 0;
		private $occurValue = 0;
		private $filterValueArr;
		private $dataHashtable;
		private $hashArray;
		
		
		public function __construct($_filterKey){
			parent::__construct();
			$this->dataHashtable = $this->getIndustry();
			$this->hashArray 	  = array();
			$this->filterValueArr = array();
			if(!empty($_filterKey))
				$this->filterKeyArr = explode(',',$_filterKey);
			else
				throw Exception("Invalid data");
		}
		
		public function setFilterValues( $_uid , $_filterValue ){
			$this->uid = $_uid;
			$this->filterValueArr = explode(',',$_filterValue);
		}
		
		private function applyFilter(){
			
			foreach($this->filterKeyArr as $keyElement){
				foreach($this->filterValueArr as $valElement){
					$outcomeString = $keyElement.','.$valElement;
					if(array_key_exists($outcomeString, $this->dataHashtable )){
							$this->hashArray[] = $this->dataHashtable[$outcomeString];
					}
				}
			}
			if(!empty($this->hashArray))
				$this->maxValue = max($this->hashArray);
			if($this->maxValue == 0 ){
					
			}else{
				$hashStrArray = Arrays::floatToString($this->hashArray);
				$repeatingElementsArray 	= array_count_values($hashStrArray);
				if(array_key_exists((string)$this->maxValue , $repeatingElementsArray)){
					$this->occurValue = $repeatingElementsArray[(string)$this->maxValue];
				}
			}			
		}
		
		public function getRefinedValue(){
			$this->applyFilter();
			//$output = array( (string)$this->maxValue => $this->occurValue);
			$output =  array((string)$this->maxValue , $this->occurValue);
			$this->disposePointer();
			return $output; 
		}
		
		private function disposePointer(){
			$this->uid = 0;
			$this->maxValue = 0;
			$this->occurValue = 0;
			$this->hashArray 	  = array();
			$this->filterValueArr = array();
		}
		
	} //@
	
	
	
	
	/*
	$keyString = "education,internet,technology";
	$allArray = array(4=>'accounting,finance,internet',3=>'education,internet', 5=>'internet,education,technology',2=>'hotels,restuarants',6=>'banking,accounting,finance',7=>'banking,internet,consulting',8=>'education',9=>'internet,technology' , 11=>'communications' );
	$outputArr = array();
	

	$obj = new IndustryFilter($keyString);
	foreach($allArray as $uid=>$values){
		$obj->setFilterValues( $uid , $values );
		$tmpArr = $obj->getRefinedValue();
		$outputArr[] = array($tmpArr[0],$tmpArr[1], $uid);
	}
	*/

	
	
	/*
	$itemsArr = array();
	foreach($outputArr as $key=>$val){
		$itemsArr[] = array(key($val));	
	}
	*/
	
	/*
	class Industry extends DefaultScore{
		
		private $hashtable ;
		private $keyArr;
		private $allArr;
		
		
		public function __construct($keyString,$allArray){
			parent::__construct();
			$this->hashtable = $this->getIndustry();
			$this->keyArr = explode(',',$keyString);
			$this->allArr    = $allArray;	
		}
		
		
		public function check(){
			
			$userArr = array();
			
			foreach($this->allArr as $uid => $col){
				$tmpArr = array();
				foreach($this->keyArr as $outcome){
					$childArr = explode(',',$col);
					foreach($childArr as $child){
						$possible = $outcome .','.$child;
						if(array_key_exists($possible, $this->hashtable )){
							$tmpArr[] = $this->hashtable[$possible];
						}
					}
				}
				$maxValue 	= max($tmpArr);
				$floatArr = $this->floatToString($tmpArr);
				$occArr 	= array_count_values($floatArr);
				if(array_key_exists('1',$occArr)){
					$userArr[$uid] = $occArr[1];	
				}else{
					$userArr[$uid] = 0;	
				}
			}
		}
		public function floatToString($floatArray){
			$memoryArr = array();
			foreach($floatArray as $arrayKey => $arrayValue){
				if(is_float($arrayValue)){
					$memoryArr[$arrayKey] = (string)$arrayValue;
				}else{
					$memoryArr[$arrayKey] = $arrayValue;
				}
			}
			return $memoryArr;		
		}
		public function getOutcomes(){			
		}
	}
	*/
	

	

	
	
	
	
	/*
		@  common helpers
		******************************************************************************
	*/
	class Arrays {
		
		public static function floatToString($floatArray){
			$memoryArr = array();
			foreach($floatArray as $arrayKey => $arrayValue){
				if(is_float($arrayValue)){
					$memoryArr[$arrayKey] = (string)$arrayValue;
				}else{
					$memoryArr[$arrayKey] = $arrayValue;
				}
			}
			return $memoryArr;		
		}
		
			
	} //@

	
	
	
	

