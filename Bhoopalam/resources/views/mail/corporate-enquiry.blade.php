<h2>Hello Admin,</h2>
You received Corporate enquiry from hotelmitra.com<br><br>
<b>Compony:</b> {{ $compony_type }}<br>
<b>Number Of Person:</b> {{ $no_person }}<br>
<b>Check Date:</b> {{ $t_start }}<br>
<b>Check Out Date:</b> {{ $t_end }}<br>
<b>Location:</b> {{ \App\Models\Location::where('id',$location)->value('title') }}<br>
<b>Hotel:</b> {{ \App\Models\Hotel::where('id',$hotel)->value('title') }}<br>
<b>Email:</b> {{ $email }}<br>
<b>Message:</b> {{ $msg }}<br>
