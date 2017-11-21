elifeLibrary {
    stage 'Checkout', {
        checkout scm
    }

    stage 'Project tests', {
        elifeLocalTests "./project_tests.sh", ["build/phpunit.xml"]
    }
}
