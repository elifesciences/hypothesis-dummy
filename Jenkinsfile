elifeLibrary {
    def commit
    stage 'Checkout', {
        checkout scm
        commit = elifeGitRevision()
    }

    def image
    stage 'Build image', {
        sh "IMAGE_TAG=${commit} docker-compose -f docker-compose.yml -f docker-compose.ci.yml build"
        image = DockerImage.elifesciences(this, 'hypothesis-dummy', commit)
    }

    stage 'Project tests', {
        dockerProjectTests 'hypothesis-dummy', commit
        try {
            sh "IMAGE_TAG=${commit} docker-compose -f docker-compose.yml -f docker-compose.ci.yml up -d"
            sh "IMAGE_TAG=${commit} docker-compose -f docker-compose.yml -f docker-compose.ci.yml exec -T cli ./smoke_tests.sh"
        } finally {
            sh 'docker-compose -f docker-compose.yml -f docker-compose.ci.yml down'
        }
    }

    elifeMainlineOnly {
        stage 'Push image', {
            image.push()
            image.tag('latest').push()
        }
    }
}
