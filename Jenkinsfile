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
        // TODO: if we could use $PROJECT_FOLDER provided by the image,
        // we may avoid passing `folder`?
        dockerProjectTests 'hypothesis-dummy', commit, '/srv/hypothesis-dummy'
    }

    elifeMainlineOnly {
        stage 'Push image', {
            image.push()
            image.tag('latest').push()
        }
    }
}
