<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style="background-color: #f4feff">
<div class="container">
    <div class="row">
        <div class="p-4">
            <h1>Project Crud With Ajax And Pure JavaScript😍</h1>
            <hr>
            <form action="{{route('project.store')}}" method="post" class="col-md-5" role="form">
                @csrf
                <div class="form-group">
                    <label for="name" class=" control-label">Name</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" placeholder="Enter Project Name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="author" class="control-label">Author</label>

                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="author" placeholder="Enter Project Author">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 my-2">
                        <div>
                            <label for="status">Status</label>
                            <input type=checkbox name=status id=status value="on"/>
                            <input type="hidden" name="status" id="hidden-status" value="off"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <a class="btn btn-primary form-control" id="send">Sign in</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <hr>
    <section class="container">
        <div class="row">
            <table id="example" class="table table-striped table-bordered " style="width:100%;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>

                @foreach($projects as $project)
                    <tr>
                        <td>{{$project->name}}</td>
                        <td>{{$project->author}}</td>
                        <td>{{$project->status}}</td>
                        <td>
                            <a href="{{route('project.update', $project->id)}}" class="btn btn-primary">Edit Project</a>
                        </td>
                        <td>
{{--                            <a href="{{route('project.destroy', $project->id)}}" class="btn btn-danger" id="deleteRow">Delete Project</a>--}}
                            <a class="delete btn btn-danger" id="{{$project->id}}">Delete Project</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </section>
</div>
<script>

    document.querySelector('#send').onclick = () => {
        let request = new XMLHttpRequest();
        request.open("POST", '/api/project', true);
        request.setRequestHeader("Accept", "application/json");
        request.onreadystatechange = () => {
            if (request.readyState === 4 && request.status === 200) {
                console.log(request.response);
            }
        }
        const name = document.getElementById('name').value;
        const author = document.getElementById('author').value;
        var checkbox = document.getElementById("status");
        var hiddenInput = document.getElementById("hidden-status");
        if (checkbox.checked) {
            hiddenInput.value = "1";
        } else {
            hiddenInput.value = "0";
        }
        const form = new FormData();
        form.append('name', name);
        form.append('author', author);
        form.append('status', hiddenInput.value);
        request.send(form);
    }

    //////////////////////////////////////////////////////////////////////////////////

    document.querySelectorAll('.delete').forEach((e) => {
        e.onclick = () => {
            let request = new XMLHttpRequest();
            // request.setRequestHeader("Accept", "application/json");
            request.open("DELETE", `api/project/destroy/${e.id}`, true);
            // request.onreadystatechange = () => {
            //     if (request.readyState === 4 && request.status === 200) {
            //         console.log(request.response);
            //     }
            // }
            let id = e.id;
            const form = new FormData();
            form.append('id', id);
            request.send(form);
        }
    });

</script>
</body>
</html>

