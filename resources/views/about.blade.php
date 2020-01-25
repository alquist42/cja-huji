@extends('layouts.app')

@section('content')
    <h1 class="text-center my-5">About Us</h1>
    <div class="container text-center about">
        <p>The Center for Jewish Art (CJA) is a research institute at the Hebrew University of Jerusalem, devoted to
            the documentation and research of Jewish visual culture. Established in 1979, it documented and
            researched objects of Jewish art in ca. 800 museums, libraries, private collections and synagogues in 41
            countries. Today, the Center's archives and collections constitute the largest and most comprehensive
            body of information on Jewish art in existence. The CJA’s research and documentation is included in the
            <a href="{{ url($projects['cja']['url']) }}">Bezalel Narkiss Index of Jewish Art</a>.</p>
        <p>The Center for Jewish Art at the Hebrew University of Jerusalem was established in 1979 by Professor
            Bezalel Narkiss, Israel Prize laureate, with an aim to document objects of Jewish art and produce a
            comprehensive iconographical index of Jewish subjects. The Center was an outcome of Narkiss’s
            iconographical research of medieval Hebrew illuminated manuscripts, which he initiated with Professor
            Gabrielle Sed-Rajna in 1974. The Index initially consisted of four sections: a Section of Hebrew
            Illuminated Manuscripts, of Sacred and Ritual Objects, of Ancient Jewish Art, and of Modern Jewish
            Art.</p>

        <p>Professor Bezalel Narkiss headed the CJA until 1991. The next director, Professor Aliza Cohen-Mushlin,
            established a fifth section for Jewish Ritual Architecture and Funerary Art. Under her leadership the
            CJA undertook many research expeditions to post-Communist Central and Eastern Europe, in order to
            measure endangered synagogues and tombstones in regions, which were previously inaccessible to western
            scholars. In addition, from 1994 CJA documented those synagogues in Germany which survived the Nazi
            regime and were not demolished in Kristallnacht. The documentation projects in Germany were done in
            cooperation with the Department of Architectural History at the Technical University in Braunschweig,
            headed by Professor Harmen H. Thies. In 1997 this cooperation was institutionalized as Bet Tfila
            Research Unit for Jewish Architecture in Europe.
        </p>
        <div class="row my-5 justify-content-center">
            <div class="col-12">
                <h2 class="mb-4 h1 text-center">The founder</h2>
            </div>
            <div class="col-12">
                <div class="mx-auto shadow rounded-circle mb-5 founder"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/narkiss.jpg')">
                </div>
                <h3>Prof. Bezalel Narkiss</h3>
                <h4><em>1996-2008</em></h4>
                <a href="/home/browser.php?mode=my_path_en">"My Path Through Art"</a> :
                <a href="/home/browser.php?mode=narkiss_cv">Biography</a>, <a
                        href="/home/browser.php?mode=narkiss_publ">Publications</a>
            </div>
            <div class="col-12">
                <h2 class="my-5 h1 text-center">Researchers and Staff</h2>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/volodia.jpg'); background-position: 0 20%">
                </div>
                <h3>Dr. Vladimir Levin</h3>
                <h4><em>Director</em></h4>
                <a target="_blank" href="http://huji.academia.edu/VladimirLevin">read more...</a>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/aliza.jpg'); background-position: 0 30%">
                </div>
                <h3>Prof. Aliza Cohen-Mushlin</h3>
                <h4><em>Head, The Bezalel Narkiss <br> Index of Jewish Art <br> Head of Bet Tfila - Research <br> Unit
                        for Jewish Architecture</em></h4>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/sergei.jpg')">
                </div>
                <h3>Dr. Sergey R. Kravtsov</h3>
                <h4><em>Senior Researcher<br>Section of Jewish Ritual Architecture</em></h4>
                <a target="_blank" href="http://huji.academia.edu/SergeyKravtsov">read more...</a>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/michal.jpg'); background-position: 0 20%">
                </div>
                <h3>Michal Sternthal</h3>
                <h4><em>Head of the Section of Hebrew Illuminated Manuscripts and Printed Books</em></h4>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/dagmara.jpg'); background-position: 0 20%">
                </div>
                <h3>Dr. Dagmara Budzioch</h3>
                <h4><em>Researcher<br>The Esther Scrolls Project<br> Section of Hebrew Illuminated Manuscripts and
                        Printed Books</em></h4>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/anna.jpg'); background-position: 0 20%">
                </div>
                <h3>Dr. Anna Berezin</h3>
                <h4><em>Head of the Section of Sacred and Ritual Objects</em></h4>
                <a target="_blank" href="http://independent.academia.edu/AnnaBerezina1">read more...</a>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/ira.jpg'); background-position: 0 20%">
                </div>
                <h3>Dr. Irina Chernetsky</h3>
                <h4><em>Volunteer <br> Section of Sacred and Ritual Objects</em></h4>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/katia.jpg'); background-position: 0 20%">
                </div>
                <h3>Ekaterina Sosensky</h3>
                <h4><em>Research Assitant<br>Section of Sacred and Ritual Objects</em></h4>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/tova.jpg'); background-position: center">
                </div>
                <h3>Tova Szeintuch</h3>
                <h4><em>Volunteer<br>Section of Hebrew Illuminated Manuscripts</em></h4>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/zoya.jpg'); background-position: center">
                </div>
                <h3>Dipl.-Ing. Zoya Arshavsky</h3>
                <h4><em>Volunteer<br>Section of Jewish Ritual Architecture</em></h4>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/ivan.jpg'); background-position: 0 20%">
                </div>
                <h3>Dipl.-Ing. Ivan Ceresnjes</h3>
                <h4><em>Volunteer<br>Section of Jewish Ritual Architecture</em></h4>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/gilad.jpg'); background-position: center">
                </div>
                <h3>Gilad Hemed</h3>
                <h4><em>Director of DevOps, Web Master, Front End Developer, Graphic Designer and Administration
                        Director</em></h4>
            </div>
            <div class="col-md-6 mb-4">
                <div class="mx-auto shadow rounded-circle mb-5 researchers-staff"
                     style="background-image: url('http://cja.huji.ac.il/home/pics/about/sofya.jpg'); background-position: center">
                </div>
                <h3>Sofya Uspenskaya</h3>
                <h4><em>Full-Stack Web Developer</em></h4>
            </div>
        </div>
        <h2 class="my-5 h1 text-center">Academic Committee</h2>
        <h3>Prof. Edwin Seroussi, chair</h3>
        <h3>Dr. Lola Kantor-Kazovsky</h3>
        <h3>Prof. Avraham Novershtern</h3>
        <h3>Prof. Rina Talgam</h3>
        <h3>Prof. Israel Yuval</h3>


    </div>
    </div>
@endsection