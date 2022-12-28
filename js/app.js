const btnAdd = document.querySelector('#btnAdd');
const listbox = document.querySelector('#list');
const framework = document.querySelector('#framework');

btnAdd.onclick = (e) => {
  e.preventDefault();

  // validate the option
  if (framework.value == '') {
    alert('Please enter the name.');
    return;
  }
  // create a new option
  //const option = new Option(framework.value, framework.value);
  var option = document.createElement("option");
option.text = framework.value;
  // add it to the list
  listbox.add(option);

  // reset the value of the input
  framework.value = '';
  framework.focus();
};

