const tabs=document.querySelectorAll('.element');
const toggle=document.querySelector('.toggle');
const leftNav=document.querySelector('.left-nav');
const exit=document.querySelector('.exit');
const moonIcon = document.querySelector('.fa-moon');
const sunIcon = document.querySelector('.fa-sun');
const overlayTheme = document.querySelector('.theme .overlay');
const addTaskSection = document.querySelector('.add-task');
const addTaskButton = document.querySelector('.to-do-window .title a');
const addTaskNav= document.getElementById('add-tasks');
const existAddTask = document.querySelector('.add-task .fa-times');
const sections=document.querySelectorAll('section');
const filterButtons = document.querySelectorAll('.filter-container span');
const taskStatus = document.querySelectorAll('.task .task-status');
const taskArea = document.querySelectorAll('.task');
var screenWidth = window.screen.width;
const body = document.body;

tabs.forEach((ele)=>{
    ele.addEventListener('click',function(){
        tabs.forEach(function(tab){
            tab.classList.remove('active');
        });
        ele.classList.add('active');
        sections.forEach(function(section){
            section.style.display='none';
        });
        sections.forEach(function(section){

           if(section.id==ele.id){
            if(section.id=="add-tasks"){
               sections[0].style.display='inline-block';
            }
               section.style.display='inline-block';
           }
        });
    });
});

setInterval(()=>{
   if(screenWidth>988){
     leftNav.style.transform='translateX(0)';
    }
     screenWidth = window.screen.width;
    },100);

toggle.addEventListener('click',function(){
    leftNav.style.transform='translateX(0)';
});

exit.addEventListener('click',function(){
    leftNav.style.transform='translateX(-100%)';
});

// change theme
moonIcon.addEventListener('click', () => {
    body.classList.remove('light');
    body.classList.add('dark');
    overlayTheme.style.transform="translateX(130%)";
});

sunIcon.addEventListener('click', () => {
    body.classList.remove('dark');
    body.classList.add('light');
    overlayTheme.style.transform="translateX(0%)";
});

// add task dialog
addTaskButton.addEventListener('click',function(){
    addTaskSection.style.visibility='visible';
});

addTaskNav.addEventListener('click',function(){
    addTaskSection.style.visibility='visible';
});

existAddTask.addEventListener('click',()=>{
    addTaskSection.style.visibility='hidden';
    addTaskNav.classList.remove('active');
    tabs[0].classList.add('active');
});

// filter buttons
filterButtons.forEach(function(btn){
    btn.addEventListener('click',function(){
        filterButtons.forEach(function(btn){
            btn.classList.remove('active');
        });
        btn.classList.add('active');

        const status = btn.getAttribute("data-selection");
        taskStatus.forEach(function(task){
            if(status=='all'){
                taskStatus.forEach(function(t){
                    task.parentElement.style.display="grid";
                });
                return;
            }
             else if(task.getAttribute('data-status')==status){
                task.parentElement.style.display="grid";
             }
             else {
                task.parentElement.style.display="none";
             }
        });
    });
});