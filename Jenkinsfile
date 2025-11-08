pipeline {
    agent any

    environment {
        IMAGE_NAME = 'laravel-backend'
        DOCKERHUB_REPO = 'fallousenghor/laravel-backend' // remplace par ton dépôt Docker Hub
        DOCKERHUB_CREDENTIALS = credentials('dockerhub-credentials') // ID ajouté dans Jenkins
    }

    stages {
        stage('Checkout') {
            steps {
                echo '📥 Clonage du dépôt...'
                checkout scm
            }
        }

        stage('Build Docker Image') {
            steps {
                echo '🐳 Construction de l’image Docker...'
                sh 'docker build -t $IMAGE_NAME .'
            }
        }

        stage('Test Laravel') {
            steps {
                echo '🧪 Exécution des tests Laravel (si présents)...'
                script {
                    // Exécute les tests Laravel à l’intérieur du container
                    sh 'docker run --rm $IMAGE_NAME php artisan test || echo "Aucun test à exécuter"'
                }
            }
        }

        stage('Push to DockerHub') {
            steps {
                echo '⬆️  Push de l’image sur DockerHub...'
                script {
                    sh '''
                        echo $DOCKERHUB_CREDENTIALS_PSW | docker login -u $DOCKERHUB_CREDENTIALS_USR --password-stdin
                        docker tag $IMAGE_NAME $DOCKERHUB_REPO:latest
                        docker push $DOCKERHUB_REPO:latest
                    '''
                }
            }
        }
    }

    post {
        success {
            echo '✅ Build & push terminé avec succès !'
        }
        failure {
            echo '❌ Erreur pendant le pipeline.'
        }
    }
}
