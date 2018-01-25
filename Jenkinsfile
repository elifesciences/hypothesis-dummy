elifeLibrary {
    def commit
    stage 'Checkout', {
        checkout scm
        commit = elifeGitRevision()
    }

    def image
    stage 'Build image', {
        dockerBuild 'hypothesis-dummy', commit
        image = DockerImage.elifesciences(this, 'hypothesis-dummy', commit)
    }

    stage 'Project tests', {
        // TODO: steps to be extracted in elife-jenkins-workflow-libs
        sh "docker build -f Dockerfile.ci -t elifesciences/hypothesis-dummy:${commit} --build-arg commit=${commit} ."
        sh "docker run elifesciences/hypothesis-dummy_ci:${commit}"
    }

    elifeMainlineOnly {
        stage 'Push image', {
            image.push()
            image.tag('latest').push()
        }
    }
}
