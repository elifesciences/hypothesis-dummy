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
        elifeLocalTests "./project_tests.sh", ["build/phpunit.xml"]
    }

    elifeMainlineOnly {
        stage 'Push image', {
            image.push()
            image.tag('latest').push()
        }
    }
}
