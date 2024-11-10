function setBlockActive(e) {
	e.stopPropagation();
    e.target.classList.toggle('active');
    e.target.getElementsByTagName('input')[0].checked = !e.target.getElementsByTagName('input')[0].checked;
}

function setBlockActWDT(elem) {
	elem.classList.toggle('active');
    elem.getElementsByTagName('input')[0].checked = !e.target.getElementsByTagName('input')[0].checked;
}

const boxes = document.getElementsByClassName('checkbox');

for (var i = 0; i < boxes.length; i++) {
	boxes[i].addEventListener("click", setBlockActive);
	var flag = FLAGS & (1 << i);
	if (flag > 0) {
		setBlockActWDT(boxes[i]);
	}
}