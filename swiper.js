// swiper

var pageSwiper = new Swiper("#page-swiper", {
    direction: "horizontal",
    loop: false
});

var replySwiper = new Swiper("#reply-swiper", {
    direction: "horizontal",
    loop: false
});

var holeSwiper = new Swiper("#hole-swiper", {
    direction: "horizontal",
    loop: false
});

// pie chart
const ctx = document.getElementById('reply-time-chart');

new Chart(ctx, {
    type: 'pie',
    data: {
        labels: [
            '深夜',
            '上午',
            '下午',
            '夜晚'
        ],
        datasets: [{
            label: '发言时间统计',
            data: [
                document.getElementById('reply-midnight').innerHTML,
                document.getElementById('reply-morning').innerHTML,
                document.getElementById('reply-afternoon').innerHTML,
                document.getElementById('reply-evening').innerHTML
            ],
            backgroundColor: [
                '#ADA2FF',
                '#FFF8E1',
                '#FFE5F1',
                '#C0DEFF'
            ],
            hoverOffset: 4,
            borderWidth: 0
        }]
    },
    options: {
        plugins: {
            legend: {
                maxWidth: 200,
                labels: {
                    color: '#FFF'
                }
            }
        }
    }
});