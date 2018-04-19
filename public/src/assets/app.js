let p = null

function bindEvents(p) {

    p.on('error', err => {
        console.log('Error', err)
    })

    p.on('signal', data => {
        document.querySelector('#offer').textContent = JSON.stringify(data)
    })

    p.on('stream', stream => {
        let video = document.querySelector('#receiver-video')
        video.volume = 0
        video.src = window.URL.createObjectURL(stream)
        video.play()
    })

}


document.querySelector('#start').addEventListener('click', e => {

    navigator.getUserMedia({
        audio: true,
        video: true
    }, function (stream) {
        p = new SimplePeer({
            initiator: true,
            stream: stream,
            config: {
                'iceServers': [
                    {
                        'url': 'stun:stun.l.google.com:19302'
                    },
                    {
                        'url': 'turn:192.158.29.39:3478?transport=udp',
                        'credential': 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
                        'username': '28224511:1379330808'
                    },
                    {
                        'url': 'turn:192.158.29.39:3478?transport=tcp',
                        'credential': 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
                        'username': '28224511:1379330808'
                    }
                ]
            },
            trickle: false
        })

        bindEvents(p)

        let emitterVideo = document.querySelector('#emitter-video')
        emitterVideo.volume = 0
        emitterVideo.src = window.URL.createObjectURL(stream)
        emitterVideo.play()
    }, function () { })

})

document.querySelector('#incoming').addEventListener('submit', e => {
    e.preventDefault()
    if (p == null) {
        p = new SimplePeer({
            initiator: false,
            trickle: false,
            config: {
                'iceServers': [
                    {
                        'url': 'stun:stun.l.google.com:19302'
                    },
                    {
                        'url': 'turn:192.158.29.39:3478?transport=udp',
                        'credential': 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
                        'username': '28224511:1379330808'
                    },
                    {
                        'url': 'turn:192.158.29.39:3478?transport=tcp',
                        'credential': 'JZEOEt2V3Qb0y27GRntt2u2PAYA=',
                        'username': '28224511:1379330808'
                    }
                ]
            }
        })
        bindEvents(p)
    }

    p.signal(JSON.parse(e.target.querySelector('textarea').value))

})