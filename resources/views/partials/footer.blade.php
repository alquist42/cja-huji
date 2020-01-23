<!-- Footer -->
<div class="container-fluid">
    <div class="card mt-4 row">
        <footer class="page-footer font-small blue pt-4">

            <!-- Footer Links -->
            <div class="container text-center text-md-left">

                <!-- Grid row -->
                <div class="row">

                    <!-- Grid column -->
                    <div class="col-md-6 mt-md-0 mt-3">

                        <!-- Content -->
                        <h5 class="text-uppercase">The Center for Jewish Art of The Hebrew University of Jerusalem</h5>

                    </div>
                    <!-- Grid column -->

                    <hr class="clearfix w-100 d-md-none pb-3">

                    <!-- Grid column -->
                    <div class="col-md-3 mb-md-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase">Projects</h5>

                        <ul class="list-unstyled">
                            @foreach ($projects as $slug => $project)
                                <li>
                                    <a href="{{ url($project['sub_project'] ? $slug : ($slug . '/items')) }}">{{ $project['title'] }}</a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 mb-md-0 mb-3">

                        <!-- Links -->
                        <h5 class="text-uppercase">Pages</h5>

                        <ul class="list-unstyled">
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#">Activities</a>
                            </li>
                            <li>
                                <a href="#">Publications</a>
                            </li>
                            <li>
                                <a href="#">About</a>
                            </li>
                        </ul>

                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row -->

            </div>
            <!-- Footer Links -->

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© {{ date('Y') }}. The Center for Jewish Art.
                <a href="{{ url('copyrights') }}">Copyrights</a>
            </div>
            <!-- Copyright -->

        </footer>
    </div>
</div>
<!-- Footer -->
