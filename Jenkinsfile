pipeline{
    // agent{
    //     label 'ubuntu'
    // }
    
    agent any
    
    tools{
        dockerTool "docker"
    }
    
    
    stages{

        stage('checkout'){
            steps{
                checkout([$class: 'GitSCM', branches: [[name: '*/main']], extensions: [], userRemoteConfigs: [[credentialsId: 'jen-git', url: 'https://github.com/tvc-ctg/laravel-php.git']]])
            }
        }
        
        // stage('PHP installation'){
        //     steps{
        //         sh '''
        //         sudo apt-get install -y software-properties-common
        //         sudo add-apt-repository -y ppa:ondrej/php
        //         sudo apt-get -y install php8.1
        //         sudo apt-get -y update 
        //         sudo apt-get -y upgrade
        //         sudo curl -sS https://getcomposer.org/installer | php
        //         sudo mv composer.phar /usr/local/bin/composer
        //         php -v
        //         composer -v
        //         '''
        //     }
        // }
        
        stage('build'){
            environment {
                API_URL= "http://20.106.244.51"
                DB_HOST = credentials("laravel-host")
                DB_DATABASE = credentials("laravel-database")
                DB_USERNAME = credentials("laravel-user")
                DB_PASSWORD = credentials("laravel-password")
            }
            steps{
                sh 'echo ==========================build================================'
                sh 'sudo apt install openssl php-common php-curl php-json php-mbstring php-mysql php-xml php-zip  -y'
                sh 'php -v'
                
                sh 'sudo composer update'
                sh 'composer install'
                sh 'cp .env.example .env'
                sh 'echo API_URL=${API_URL} >> .env'
                sh 'echo DB_HOST=${DB_HOST} >> .env'
                sh 'echo DB_USERNAME=${DB_USERNAME} >> .env'
                sh 'echo DB_DATABASE=${DB_DATABASE} >> .env'
                sh 'echo DB_PASSWORD=${DB_PASSWORD} >> .env'
                // sh 'composer -v'
                // sh 'php artisan config:clear'
                // sh 'php artisan cache:clear'
                sh 'php artisan key:generate'
                sh 'sudo php artisan migrate'
                // sh 'php artisan serve'
            }
        }

        stage("Unit Test Cases"){
            
            steps{
                sh 'echo ===============================Test Cases================================='
                sh 'sudo chmod -R ugo+rw storage'
                sh 'sudo php artisan test'  
                junit 'codeCoverage/test.xml'
            }
        }

        stage('Code Coverage'){
            steps{
                
                sh 'echo ===============================Code Coverage================================='
                sh 'sudo ./vendor/bin/phpunit'
                // sh 'sudo chown -R 1000:1000 ./codeCoverage'
                // sh 'php artisan test --coverage-html codeCoverage/'
                publishHTML([allowMissing: false, alwaysLinkToLastBuild: false, keepAll: false, reportDir: 'codeCoverage', reportFiles: 'index.html', reportName: 'HTML Report', reportTitles: ''])
                //clover(cloverReportDir: 'codeCoverage', cloverReportFileName: 'clover.xml', failingTarget: [], healthyTarget: [conditionalCoverage: 80, methodCoverage: 70, statementCoverage: 80], unhealthyTarget: [])
                // publishCoverage adapters: [cobertura('codeCoverage/cobertura.xml')], sourceFileResolver: sourceFiles('NEVER_STORE')
                // cobertura autoUpdateHealth: false, autoUpdateStability: false, coberturaReportFile: 'codeCoverage/cobertura.xml', conditionalCoverageTargets: '70, 0, 0', failUnhealthy: false, failUnstable: false, lineCoverageTargets: '80, 0, 0', maxNumberOfBuilds: 0, methodCoverageTargets: '80, 0, 0', onlyStable: false, sourceEncoding: 'ASCII', zoomCoverageChart: false
                clover(cloverReportDir: 'codeCoverage', cloverReportFileName: 'clover.xml',
                // optional, default is: method=70, conditional=80, statement=80
                healthyTarget: [methodCoverage: 70, conditionalCoverage: 80, statementCoverage: 80],
                // optional, default is none
                unhealthyTarget: [methodCoverage: 50, conditionalCoverage: 50, statementCoverage: 50],
                // optional, default is none
                failingTarget: [methodCoverage: 0, conditionalCoverage: 0, statementCoverage: 0]
                )
            }
        }
        
        stage('Static Code Analysis with Larastan'){
            steps{
                sh 'echo ===============================Static analysis with larastan================================='
                sh 'composer require --dev nunomaduro/larastan'
                sh "vendor/bin/phpstan analyse --memory-limit=2G"
            }
        }
        
        stage('Static code analysis with SonarQube'){
            steps{
                withSonarQubeEnv('sonar') {
                    sh '''
                    echo '===============================SonarQube Analysis================================='
                    /opt/sonar-scanner/bin/sonar-scanner -X
                    '''
                }
            }
        }
        
//         stage('Docker Build'){
            
//             steps{
//                 sh'''
//                 docker -v
//                 sudo docker image ls
//                 sudo docker container ls
//                 '''
//                 // php artisan sail:install
//                 // sudo docker-compose up
//             }
//         }
    }
}
