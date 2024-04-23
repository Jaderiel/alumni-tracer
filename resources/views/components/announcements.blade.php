        <div class="col-lg-4">
            <div class="card" style="width: 350px; border-radius: 20px;">

                <div class="card-body-announcement" style="background-color: #162F65">
                    <div class="card-body" style="display: flex; justify-content: center">
                        <h4 class="text-center" style="align-self: center">ANNOUNCEMENT!!</h4>
                    </div>
                </div>
                
                    @foreach($announcements as $announcement)
                    <div class="announcement-info">
                        <div>
                            <i class="fa-solid fa-square-check" style="color: green;"></i>
                        </div>
                        <div class="title-desc">
                            <p class="p-title">{{ $announcement->ann_title }}</p>
                            <P>{{ $announcement->ann_details }}</P>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>