<div>
    <div class="row">
        <div class="col-md-12">
            @if(session()->has('success'))
                <div class="alert alert-success mb-4">
                    <strong>Great!</strong>
                    <hr class="message-inner-separator">
                    <p>{!! session()->get('success') !!}</p>
                </div>
            @endif
            @if(session()->has('error'))
                <div class="alert alert-warning mb-4">
                    <strong>Whoops!</strong>
                    <hr class="message-inner-separator">
                    <p>{!! session()->get('error') !!}</p>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        @foreach($plans as $plan)
            <div class="col-xl-3 col-md-6">
            <div class="card plan-box">
                <div class="card-body p-4">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h5>{{$plan->plan_name ?? '' }} @if($plan->id == Auth::user()->plan_id)<label class="badge-soft-danger float-end badge">Current</label>@endif</h5>

                            <p class="text-muted">{{$plan->description ?? '' }}</p>
                        </div>
                        <div class="flex-shrink-0 ms-3">
                            <i class="bx bx-walk h1 text-primary"></i>
                        </div>
                    </div>
                    <div class="py-4">
                        <h2><sup><small>$</small></sup> {{number_format($plan->amount) ?? 0 }}/ <span class="font-size-13">Per month</span></h2>
                    </div>
                    @if($plan->id != Auth::user()->plan_id)
                    <div class="text-center plan-btn">
                        <a href="javascript: void(0);" class="btn btn-primary btn-sm waves-effect waves-light">Subscribe</a>
                    </div>
                    @endif

                    <div class="plan-features mt-5">
                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Free Live Support</p>
                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Unlimited User</p>
                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> No Time Tracking</p>
                        <p><i class="bx bx-checkbox-square text-primary me-2"></i> Free Setup</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

