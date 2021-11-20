
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table table-bordered table-hover table-responsive">
                        <thead id="tableheader">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Distance</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody id="userdata">
                        <tr>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>

    $(function(){
        $.ajax({
            url: '{{'/user/list'}}',
            type: 'GET',
            success: function (res) {
                const response = JSON.parse(res);
                const size = response.list_size;
                const users = response.data;
                var row = '';
                if (size > 0)
                {
                    $.each(users, function (index, user) {
                        row += '<tr>';
                        //id
                        row += '<td>' + user.id + '</td>';

                        //name
                        row += '<td>' + user.name + '</td>';

                        //image
                        /* row += '<td>' +
                             '<img class="card-img-top" src="' + user.profile_image_path + '"    alt="' + user.profile_image + '"  width="150px" height="150px" />'
                             + '</td>';
 */
                        // distance
                        row += '<td>' + user.distance + ' km'+ '</td>';

                        // gender
                        row += '<td>' + user.gender + '</td>';

                        // age
                        row += '<td>' + user.age + '</td>';

                        // action
                        row += '<td>' + '<button class="btn btn-sm btn-info text-white" id="' +"likeBtn"+ user.id + '"    onclick="like('+ user.id+ ')" >' +
                            '' +
                            'Like ' +
                            '</button>'+' ' +

                            '<button class="btn btn-sm btn-dark" id="' +"dislikeBtn"+ user.id + '"  disabled  onclick="dislike('+ user.id+ ')" >' +
                            '' +
                            'Dislike ' +
                            '</button>'

                            + '</td>';

                        row += '</tr>';

                    })
                }
                else
                {
                    $("#tableheader").hide();
                    row += '<h1>Sorry, No Users found in 5 Km Distance. </h1>';
                }
                $('#userdata').append(row);
            }
        });
    });


    function like(id) {
        $.ajax({
            url: '{{ url('like') }}/'+id,

            type: 'GET',
            success: function(res) {
                alert(JSON.parse(res).message);

                if (JSON.parse(res).matched === true)
                {
                    alert('It\'s a Match!');
                }

                $("#likeBtn"+id).attr("disabled", true);
                $("#dislikeBtn"+id).prop("disabled", false);

            },
            error: function () {
                alert('Please Try again later');
            }
        });

    }

    function dislike(id) {
        $.ajax({
            url: '{{ url('dislike') }}/'+id,
            type: 'GET',
            success: function(res) {
                alert( JSON.parse(res).message );

                $("#dislikeBtn"+id).attr("disabled", true);
                $("#likeBtn"+id).prop('disabled', false);

            },
            error: function () {
                alert('Please Try again later');
            }
        });
    }

</script>

