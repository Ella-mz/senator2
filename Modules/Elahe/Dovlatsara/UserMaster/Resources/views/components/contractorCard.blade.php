<div class="show-contractor-parent">
    <div class="show-contractor">

        <div class="show-contractor-content">
            <div class="show-contractor-content-desc">
                <div class="contractor-img justify-content-center align-items-center d-flex" >
                    @if($userImage!='')

                    <img src="{{asset($userImage)}}" alt="">
                    @else
                        <img src="{{asset('files/userMaster/assets/img/Rectangle 40.png')}}" alt="">
                    @endif
                </div>
                <a href="{{route('contractors.show.user', $id)}}">
                <div class="contractor-intro">

                    <div class="contractor-name d-flex justify-content-between px-3 mt-3">
                        <h3>
                            {{$name}} {{$sirName}}
                        </h3>
                        <p>
                            {{\Modules\User\Entities\User::where('slug', $id)->first()->id+10000}}
                        </p>
                    </div>
                    <div class="contractore-job d-flex justify-content-between px-3 mt-3">
                        <p>
                            {{$firstLevel1Association}}
                        </p>
                        <p>
                            {{$secondLevel1Association}}
                        </p>


                    </div>
                </div>
                <div class="contractor-profile d-flex justify-content-between px-5 mt-1">
                    <p>
                        {{$numberOfSkills}} مهارت
                    </p>
                    |
                    <p>
                        {{$numberOfProjects}} پروژه
                    </p>
                </div>
{{--                <div class="contractor-hologram">--}}
{{--                    <img src2="assets/img/Group 20.png" alt="">--}}
{{--                </div>--}}
                </a>
            </div>
        </div>


    </div>
</div>
