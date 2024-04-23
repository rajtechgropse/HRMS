@extends('header')
@section('title', 'All Users Allocation')
@section('content')

<div class="main-content-inner">
    <div class="row">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    @if (isset($modules[2]['user.create']) && $modules[2]['user.create'] == 1)

                    <h4 class="header-title float-left"> All User's Allocation List</h4>

                    @endif

                    @if(session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="clearfix"></div>
                    <div class="table-responsive">
                        <table id="style-2" class="table style-2 dt-table-hover dataTable no-footer"
                            role="grid" aria-describedby="style-2_info">
                            @foreach ($tables as $table)
                                {!! $table !!}
                            @endforeach
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        {{-- // {!! $tables->withQueryString()->links('pagination::bootstrap-5') !!} --}}
    </div>
</div>

<script>
    var $j = jQuery.noConflict();
</script>
<script>
    $(document).ready(function(){
        $('[id^="viewDetails-"]').click(function(){
            $('#modalBody').html('');
            let name = $(this).attr('data-name');
            let type = $(this).attr('data-type');
            let projectName = $(this).attr('data-projectname');
            let allocation = $(this).attr('data-allocation');
            let startDate = $(this).attr('data-startdate');
            let endDate = $(this).attr('data-enddate');
            let allDays = generateDateArray(startDate,endDate)
            
            
            let tableHead = [];
            let tableBody = [];

            for (var i = 0; i < allDays.length; i++) {
                let item = allDays[i];
                tableHead.push('<th>' + item.day + '</th>');
                tableBody.push('<td>' + item.date + '</td>');
            }

            let html = '<div class="table-responsive">';
        html += '<table class="table table-striped">';
        html += '<thead>';
        html += '<tr>';
        html += '<th>Name</th>';
        html += '<th>Designation</th>';
        html += '<th>Project Name</th>';
        html += '<th>Allocate</th>';
        html += tableHead.join('');
        html += '</tr>';
        html += '</thead>';
        html += '<tbody>';
        html += '<tr>';
        html += '<td>'+ name +'</td>';
        html += '<td>'+ type +'</td>';
        html += '<td>'+ projectName +'</td>';
        html += '<td>'+ allocation +'</td>';
        html += tableBody.join('');
        html += '</tr>';
        html += '</tbody>';
        html += '</table>';
        html += '</div>';
        $('#modalBody').html(html);

        $('#customModal').modal('show');

        })
    })
    function getDayOfWeek(dateString) {
  const daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
  const date = new Date(dateString);
  return daysOfWeek[date.getDay()];
}

function generateDateArray(startDate, endDate) {
  const dateArray = [];
  const currentDate = new Date(startDate);

  while (currentDate <= new Date(endDate)) {
    dateArray.push({
      day: getDayOfWeek(currentDate.toISOString().split('T')[0]),
      date: currentDate.toISOString().split('T')[0]
    });

    currentDate.setDate(currentDate.getDate() + 1);
  }

  return dateArray;
}


</script>
@endsection