        <div class="">
            <div class="card" style=" border-radius: 20px; height: auto; padding-bottom: 5px;"  >

                <div class="card-body-announcement" style="background-color: #162F65">
                    <div class="card-body" style="display: flex; justify-content: center">
                        <h4 class="text-center" style="align-self: center">ANNOUNCEMENT!!</h4>
                    </div>
                </div>
                
                    @foreach($announcements as $announcement)

                    @if(auth()->check() && (auth()->user()->user_type != 'Alumni'))
                        <a style="text-decoration: none;" href="{{ route('update-ann', ['id' => $announcement->id]) }}">
                            <div class="announcement-info"  >
                                <div>
                                    <i class="fa-solid fa-square-check" style="color: green;"></i>
                                </div>
                                <div class="title-desc">
                                    <p class="p-title" style="text-decoration: none;">{{ $announcement->ann_title }}</p>
                                    <P style="text-decoration: none;">{{ $announcement->ann_details }}</P>
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="announcement-info">
                            <div>
                                <i class="fa-solid fa-square-check" style="color: green;"></i>
                            </div>
                            <div class="title-desc">
                                <p class="p-title">{{ $announcement->ann_title }}</p>
                                <P>{{ $announcement->ann_details }}</P>
                            </div>
                        </div>
                    @endif

                    @endforeach
            </div>
        </div>