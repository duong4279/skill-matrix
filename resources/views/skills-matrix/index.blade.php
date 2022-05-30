@extends('layouts.app')

@section('content')
<div class="page-title"><h1>Skills Matrix</h1></div>
<div class="level-detail">
    @foreach ($levels as $level)
    <div class="d-flex">
    <div class="level" style="background-color: {{ $level->color }}">{{  $level->level }}</div>
    <span class="level-desc" >{{ $level->description }}</span>
    </div>
    @endforeach
    
</div>
<table class="table table-bordered style-table">
  <thead>
    <tr>
      <th scope="col">STT</th>
      <th scope="col">Code</th>
      <th scope="col">Name</th>
      @foreach($skills as $skill)
      <th scope="col" class="text-vertical">{{ $skill->skill_name }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{ $user->id }}</td>
      <td>{{ $user->id }}</td>
      <td>{{ $user->name }}</td>
      @foreach($skills as $skill)
      <td>
      <select class="style-select" id="selector" onchange="handleChange(this);">
      <!-- <option selected="selected" disabled hidden style="background-color: red">none</option> -->
      <?php $a = false; ?>
        @foreach ($skillLevel as $s_level )
            @if ($s_level->user_id == $user->id && $s_level->skill_id == $skill->id )
                @foreach($levels as $level)
                    @if ( $level->id == $s_level->level_id ? true : false )
                    <option value='{"level_id":"{{$level->id}}","user_id":"{{$user->id}}", "skill_id":"{{$skill->id}}"}' data-color="{{$level->color}}" selected style="background-color: transparent">{{ $level->level }}</option>
                    @else
                    <option value='{"level_id":"{{$level->id}}","user_id":"{{$user->id}}", "skill_id":"{{$skill->id}}"}' data-color="{{$level->color}}">{{ $level->level }}</option>
                    @endif
                @endforeach  
                <?php $a =true ; ?>
            @endif
        @endforeach
        @if (!$a)
              <option selected="selected" disabled style="background-color: red">-</option>
            @foreach($levels as $level)
            <option value='{"level_id":"{{$level->id}}","user_id":"{{$user->id}}", "skill_id":"{{$skill->id}}"}' data-color="{{$level->color}}">{{ $level->level }}</option>
            @endforeach 
        @endif
      </select>
      </td>
      @endforeach
    </tr>
    @endforeach
    
    
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datepicker</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('skill-level.create') }}" id="formModal" name="formModal" method="GET">
            @csrf
            <input type="hidden" name="user_id"/>
            <input type="hidden" name="skill_id"/>
            <input type="hidden" name="level_id"/>
          <div class="form-group">
            <div class='input-group date' id='datetimepicker1'>
				<div class="date-input">
				<input type='text' class="form-control" name="date" id="date"/>
				</div>
				<div class="icon-input-date">
				<span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
              </span>
				</div>
              
            </div>
          </div>
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
        <button type="submit" class="btn btn-primary" >Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')

<script>
     $(document).ready(function () {
        renderLevel();
    });
    function renderLevel(){
        let select = document.querySelectorAll("#selector");
        select.forEach(function(item) {
            item.style.backgroundColor = item.options[item.selectedIndex].getAttribute('data-color')    
        })
    }
    function handleChange(val) {
        let json = JSON.parse(val.value);
        let userIdSubmit = document.querySelector('input[name=user_id]')
        let skillIdSubmit = document.querySelector('input[name=skill_id]')
        let levelIdSubmit = document.querySelector('input[name=level_id]')

        userIdSubmit.value = json.user_id;
        skillIdSubmit.value = json.skill_id;
        levelIdSubmit.value = json.level_id;
        val.style.backgroundColor = val.options[val.selectedIndex].getAttribute('data-color')
    
      $('#exampleModal').modal('show')

    }

    function closeModal() {
      $('#exampleModal').modal('hide')
      $('#exampleModal').on('hidden.bs.modal', function (e) {
        $(this)
          .find("input,textarea,select")
            .val('')
            .end()
          .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
      })
    }

    $(function() {
        $('#datetimepicker1').datetimepicker({
        format:'DD/MM/YYYY',
        });
    })
    
    function submit() {
        // const date = $('#datetimepicker1').find("input").val()
        // console.log(date)
        // closeModal();
    }   

	$(function() {
		$("#formModal").validate({
		rules: {
			date: {
				required: true,
				
			},
		},
		messages: {
			date:{
				required:"Please select date",
			},
			}
		});
	});
</script>


@endpush