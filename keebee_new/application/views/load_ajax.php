<html>
<body>
<input type="text" name="user_id" id="user_id" value="">
<button class="btn btn-primary" onclick="view_data()">User Profile</button>

<div id="dis" style="display:none;">
	<p>ID: <span id="id"></span></p>
	<p>Name: <span id="name"></span></p>
	<p>Email: <span id="email"></span></p>
	<p>Password: <span id="password"></span></p>
	<p>Type: <span id="type"></span></p>
	<p>Parent id: <span id="parent_id"></span></p>
	<p>Push Notification: <span id="push_notification"></span></p>
	<p>Status: <span id="status"></span></p>
	<p>Created: <span id="created"></span></p>
</div><br><br><br><br>
<input type="text" name="user_id" id="tran_user_id" value="">
<button class="btn btn-primary" onclick="view_transaction()">Transaction History</button>

<div id="tran" style="display:none;">
	<p>ID: <span id="id"></span></p>
	<p>User Id: <span id="user_id"></span></p>
	<p>Amount: <span id="amount"></span></p>
	<p>Date: <span id="date"></span></p>
	<p>Detail: <span id="detail"></span></p>
	<p>Member Id: <span id="member_id"></span></p>
	<p>Duration Id: <span id="duration_id"></span></p>
	<p>Type: <span id="type"></span></p>
	<p>Created: <span id="created"></span></p>
	<p>User Name: <span id="user_name"></span></p>
</div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script>
function view_data()
    {
		var user_id = $('#user_id').val();
		 $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>User/get_transaction_history",
        data: { secretkey: 'VTTBD88NUPTGDQ85DZKA28CV4FEGRQTK', user_id: user_id},
        success:function(result) {		
			var att = JSON.stringify(result);
			var abb = JSON.parse(att);
			$('#dis').show();
			$('#id').html(abb.Profile.id);
			$('#name').html(abb.Profile.name);
			$('#email').html(abb.Profile.email);
			$('#password').html(abb.Profile.password);
			$('#type').html(abb.Profile.type);
			$('#parent_id').html(abb.Profile.parent_id);
			$('#push_notification').html(abb.Profile.push_notification);
			$('#status').html(abb.Profile.status);
			$('#created').html(abb.Profile.created);
        },
        error:function(result) {
          alert('error');
        }
		});
    }

function view_transaction()
    {
		var tran_user_id = $('#tran_user_id').val();
		 $.ajax({
		type: "POST",
        url: "<?php echo base_url();?>User/get_transaction_history",
        data: { secretkey: 'VTTBD88NUPTGDQ85DZKA28CV4FEGRQTK', user_id: tran_user_id},
        success:function(results) {		
			var arr = JSON.stringify(results);
			var acc = JSON.parse(arr);
			console.log(acc.TransactionHistory);
			$('#tran').show();
			$('#id').html(acc.TransactionHistory.id);
			$('#user_id').html(acc.TransactionHistory.user_id);
			$('#amount').html(acc.TransactionHistory.amount);
			$('#date').html(acc.TransactionHistory.date);
			$('#detail').html(acc.TransactionHistory.detail);
			$('#member_id').html(acc.TransactionHistory.member_id);
			$('#duration_id').html(acc.TransactionHistory.duration_id);
			$('#type').html(acc.TransactionHistory.type);
			$('#created').html(acc.TransactionHistory.created);
			$('#user_name').html(acc.TransactionHistory.user_name);
        },
        error:function(results) {
          alert('error');
        }
		});
    }
</script>
