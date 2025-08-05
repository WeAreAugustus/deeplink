pipeline {
    agent {
        node {
            label 'smashi-staging'
        }
    }

    environment {
        APP_KEY = 'base64:fWGXeTblS7PdaRcrv9l6FbnrdhNVHDHw9VuhR7T0Iug='
        APP_NAME = 'deeplink'
        APP_VERSION = '1.0.0'
        DOCKER_TAG = "${APP_NAME}:${APP_VERSION}"
        DB_HOST = '15.184.142.230'    
        DB_PORT = '3306'
        DB_PASSWORD = 'zE5MCRA23uOw4m9Y6hLce3iBD'
        DB_USERNAME = 'root'
        DB_NAME = 'la_deeplink'
    }

    stages {
        stage('Initialize Version') {
            steps {
                script {
                    if (!fileExists('version.txt')) {
                        writeFile file: 'version.txt', text: '1.0.0'
                    }
                    def version = readFile('version.txt').trim()
                    echo "Current version: ${version}"
                    def versionParts = version.tokenize('.')
                    versionParts[2] = (versionParts[2] as Integer) + 1
                    def newVersion = "${versionParts[0]}.${versionParts[1]}.${versionParts[2]}"
                    writeFile file: 'version.txt', text: newVersion
                    echo "New version: ${newVersion}"
                    env.APP_VERSION = newVersion
                    env.DOCKER_TAG = "${APP_NAME}:${APP_VERSION}"
                }
            }
        }

        stage('Create .env File') {
            steps {
                script {
                    writeFile file: '.env', text: """
                        APP_KEY=${APP_KEY}
                        APP_NAME=${APP_NAME}
                        APP_VERSION=${APP_VERSION}
                        DOCKER_TAG=${DOCKER_TAG}
                        DB_HOST=${DB_HOST}
                        DB_PASSWORD=${DB_PASSWORD}
                        DB_USERNAME=${DB_USERNAME}
                        DB_NAME=${DB_NAME}
                        DB_PORT=${DB_PORT}
                        APP_DEBUG=true 
                        dd(env('DB_DATABASE'));

                    """
                    echo ".env file created successfully."
                }
            }
        }


        stage('Build Docker Image') {
            steps {
                sh "sudo docker build -t ${DOCKER_TAG} ."
            }
        }

        stage('Stop and Remove Existing Container') {
            steps {
                sh "sudo docker stop ${APP_NAME} || true"
                sh "sudo docker rm ${APP_NAME} || true"
            }
        }

        stage('Run Application Container ') {
            steps {
                script {
                    echo "Running Application container "
                }
                sh """
                  sudo docker run -d \\
                    --name ${APP_NAME} \\
                    -p 5048:80\\
                    --env-file .env \\
                    --restart unless-stopped \\
                    -v /home/ubuntu/.well-known:/var/www/html/public/.well-known:ro  \\
                    ${DOCKER_TAG} 
                """
            }
        }

        /*stage('Cleanup') {
            steps {
                sh "sudo docker image prune -f"
                sh "sudo docker container prune -f"
            }
        }*/
    }

    post {
        always {
            archiveArtifacts artifacts: '**/test-results.xml', allowEmptyArchive: true
            cleanWs()
        }
        failure {
            echo 'Pipeline failed!'
        }
    }
}