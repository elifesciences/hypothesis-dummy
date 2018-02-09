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
        dockerBuildCi 'hypothesis-dummy', commit
        dockerProjectTests 'hypothesis-dummy', commit
    }

    elifeMainlineOnly {
        stage 'Push image', {
            image.push()
            image.tag('latest').push()
        }
    }
}
