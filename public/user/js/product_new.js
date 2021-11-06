 class slideImg{
        constructor(listImgSlide, listImg, prev, next) {
            this.listImgSlide = listImgSlide;
            this.listImg = listImg;
            this.prev = prev;
            this.next = next;
          }
          slide_img(){
            const listImgSlide = document.querySelector(this.listImgSlide)
            const listImg = document.querySelectorAll(this.listImg)
            const prev = document.querySelector(this.prev)
            const next = document.querySelector(this.next)


            let max = listImg.length - 1;
            let min = 0;
            let count = 0;
            let size = listImg[0].clientWidth

            let size2 = getComputedStyle(listImg[0])

            let size1 = parseFloat(size2.marginLeft)

            listImgSlide.style.transform = 'translateX(' + -count * (size + size1) + 'px)'

            next.addEventListener('click', () => {
                if (count == max-3) return;
                listImgSlide.style.transition = 'transform 0.8s linear'
                count++;
                listImgSlide.style.transform = 'translateX(' + -count * (size + size1) + 'px)'

            })

            prev.addEventListener('click', () => {
                if (count == min) return;
                console.log("hehe")
                listImgSlide.style.transition = 'transform 0.8s linear'
                count--;
                listImgSlide.style.transform = 'translateX(' + -count * (size + size1) + 'px)'

            })
        }
    }





