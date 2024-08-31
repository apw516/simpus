@extends('Template.main')
@section('container')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Master User</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="v_master_user">

            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            ambilmasteruser()
        })

        function ambilmasteruser() {
            spinneron()
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                url: '<?= route('ambilmasteruser') ?>',
                error: function(response) {
                    spinnerof()
                },
                success: function(response) {
                    spinnerof()
                    $('.v_master_user').html(response);
                }
            });
        }
    </script>
@endsection
