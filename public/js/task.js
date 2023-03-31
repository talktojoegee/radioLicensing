function updateStatus(taskId, route){
    NProgress.start();
    axios.post(route,{
        taskId:taskId
    })
        .then(res=>{
            NProgress.done();
            Toastify({
                text: "Task status updated successfully!",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "left",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function(){} // Callback after click
            }).showToast();
        });

    return false;
}
