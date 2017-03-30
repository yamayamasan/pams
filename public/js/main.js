
// $('#begin_time').on('change', function(e){
//   console.info(val);
// });

var holidaies = {
  '2': '欠勤',
  '3': '休日',
  '6': '有給',
};

var attendanceKeys = [
  'begin_time', 'end_time', 'break_time'
];

$(document).on('change', '#work_states_id', function(e) {
  var isDisabled = true;
  if (typeof holidaies[e.currentTarget.value] === 'undefined') {
    isDisabled = false;
  }

  attendanceKeys.forEach(function(atKey){
    $('#'+atKey).prop('disabled', isDisabled);
  });
});

{
}
/*
{
  $(document).on('click', '#begin_time_dropper', function(e) {
    var ele = $('#begin_time');
    ele.timeDropper();
    ele.click();
    ele.blur(function(){
      console.log('a')
    });
  });
  $('#end_time').timeDropper();

  function triggerEvent(element, event)
  {
     var evt = document.createEvent("HTMLEvents");
     evt.initEvent(event, true, true );
     return element.dispatchEvent(evt);
  }
}
*/
/*
$(document).on('click', '#StampStart', function(e) {

});
*/
