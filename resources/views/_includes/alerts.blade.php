@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success_generate'))
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success_generate') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endif