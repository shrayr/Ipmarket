<table ng-controller="MediaController" id="fields">
    <thead>
    <th>Website type</th>
    <th>Website</th>
    <th>Ad type</th>
    <th>Placement</th>
    <th>Placement type</th>
    <th>Visits per month</th>
    <th>Price</th>
    <th>View forecast</th>
    <th>Duration</th>
    <th>Cost</th>
    <th>Discount</th>
    <th>Total</th>
    <th>CPM</th>
    <th>CTR, forecast</th>
    <th>Clicks, forecast</th>
    </thead>
    <tbody>

    </tbody>
</table>
<button class="btn btn-info" id="add">Add</button>
<script>

    $("#add").click(function () {
        var cycleBlock = '<tr>';
        cycleBlock += '<td>ghj</td>';
        cycleBlock += '</tr>';
        var $cycleBlock = $(cycleBlock);
        $('#fields').append($cycleBlock);
    });
</script>