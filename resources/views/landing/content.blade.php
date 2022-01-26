@extends('landing/layout/master')

@section('title', 'Content')

@section('content')
    <!-- Page Content-->
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="text-center mb-5">
                <h1 class="fw-bolder">Content</h1>
                <p class="lead fw-normal text-muted mb-0">What's around Pererenan Nengah Guest House?</p>
            </div>
            <ul class="nav justify-content-center nav-pills mb-3 gap-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                        Facilities and Service
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Accommodation
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">
                        Beach
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <h4 class="fw-bolder">Description :</h4>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus culpa quam perspiciatis. Architecto reprehenderit quod deserunt deleniti molestiae porro officia consectetur. Rerum quis amet voluptates ipsam eos commodi consequuntur eius fuga consequatur, mollitia explicabo quisquam quibusdam fugit quo! Dolor odio ea explicabo perspiciatis sit earum quos pariatur accusamus nemo vero. Obcaecati quidem provident voluptatibus eum cupiditate saepe tenetur sit officia. Fugiat neque veritatis excepturi vitae quas ab molestias officia, nostrum ut autem, porro dolores magnam, rerum eaque corrupti dolor ad fugit necessitatibus at incidunt voluptatibus similique mollitia tenetur harum. Laudantium dignissimos deserunt ratione alias consequatur accusamus nam iure animi illo?.</p>
                    <h4 class="fw-bolder mb-2">Galery :</h4>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="https://picsum.photos/id/1008/600/350" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Galery title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="https://picsum.photos/id/1008/600/350" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Galery title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="https://picsum.photos/id/1008/600/350" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Galery title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <h4 class="fw-bolder">Description :</h4>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus culpa quam perspiciatis. Architecto reprehenderit quod deserunt deleniti molestiae porro officia consectetur. Rerum quis amet voluptates ipsam eos commodi consequuntur eius fuga consequatur, mollitia explicabo quisquam quibusdam fugit quo! Dolor odio ea explicabo perspiciatis sit earum quos pariatur accusamus nemo vero. Obcaecati quidem provident voluptatibus eum cupiditate saepe tenetur sit officia. Fugiat neque veritatis excepturi vitae quas ab molestias officia, nostrum ut autem, porro dolores magnam, rerum eaque corrupti dolor ad fugit necessitatibus at incidunt voluptatibus similique mollitia tenetur harum. Laudantium dignissimos deserunt ratione alias consequatur accusamus nam iure animi illo?.</p>
                    <h4 class="fw-bolder mb-2">Galery :</h4>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="https://picsum.photos/id/1008/600/350" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Galery title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="https://picsum.photos/id/1008/600/350" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Galery title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="https://picsum.photos/id/1008/600/350" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Galery title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <h4 class="fw-bolder">Description :</h4>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus culpa quam perspiciatis. Architecto reprehenderit quod deserunt deleniti molestiae porro officia consectetur. Rerum quis amet voluptates ipsam eos commodi consequuntur eius fuga consequatur, mollitia explicabo quisquam quibusdam fugit quo! Dolor odio ea explicabo perspiciatis sit earum quos pariatur accusamus nemo vero. Obcaecati quidem provident voluptatibus eum cupiditate saepe tenetur sit officia. Fugiat neque veritatis excepturi vitae quas ab molestias officia, nostrum ut autem, porro dolores magnam, rerum eaque corrupti dolor ad fugit necessitatibus at incidunt voluptatibus similique mollitia tenetur harum. Laudantium dignissimos deserunt ratione alias consequatur accusamus nam iure animi illo?.</p>
                    <h4 class="fw-bolder mb-2">Galery :</h4>
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="https://picsum.photos/id/1008/600/350" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Galery title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="https://picsum.photos/id/1008/600/350" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Galery title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img class="card-img-top" src="https://picsum.photos/id/1008/600/350" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Galery title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection