<div class="people-list" id="people-list">
    <div class="search" style="text-align: center">
        <a href="{{url('/home')}}" style="font-size:16px; text-decoration:none; color: white;"><i class="fa fa-user"></i> {{auth()->user()->name}}</a>
    </div>
    <ul class="list">
        @foreach($threads as $inbox)
            @if(!is_null($inbox->thread))
        <li class="clearfix">
            <a href="{{route('message.read', ['id'=>$inbox->withUser->id])}}">
              <?php $condition = (e($inbox->withUser->avatar) != "default.jpg"); ?>
              <?php if($condition) : ?>
                  <img  style="width:30px; height:30px; margin-right:20px;float:left; border-radius:50%;" src="/uploads/avatars/<?php echo e($inbox->withUser->avatar); ?>">
              <?php else : ?>
                  <span style="width: 30px; height: 30px; float:left; margin-right:20px; line-height: 30px; text-align: center; background: #263238; display: inline-block;  border-radius: 50%; color: #fff;font-size: 10px;"><?php echo e(ucfirst(substr( ($inbox->withUser->name) , 0, 1))); ?></span>

              <?php endif; ?>



                <div class="name">{{$inbox->withUser->name}}</div>
                <div class="status">
                    @if(auth()->user()->id == $inbox->thread->sender->id)
                        <span class="fa fa-reply"></span>
                    @endif
                    <span>{{substr($inbox->thread->message, 0, 20)}}</span>
                </div>
            
            </a>
        </li>
            @endif
        @endforeach

    </ul>
</div>
