<script>
export default {
    data() {
        return {
            frameInterval: null,
            elements: {
                video: null,
                canvas: null
            },
            cells: []
        }
    },
    methods: {
        buildCellsArray() {
            const cellWidth = this.elements.canvas.width / 4;
            const cellHeight = this.elements.canvas.height / 4;
            const { videoWidth, videoHeight } = this.elements.video;
            const videoWidthPerCell = videoWidth / 4;
            const videoHeightPerCell = videoHeight / 4;

            let p = 0;
            let row = 0;
            while(row < 4) {
                let col = 0;
                while(col < 4) {
                    const item = {
                        sx: videoWidthPerCell * col,
                        sy: videoHeightPerCell * row,
                        sWidth: videoWidthPerCell,
                        sHeight: videoHeightPerCell,
                        dx: cellWidth * col,
                        dy: cellHeight * row,
                        dWidth: cellWidth,
                        dHeight: cellHeight,
                        order: p
                    };
                    this.cells.push(item);
                    col +=1
                    p += 1
                }
                row += 1
            }
        },
        shuffleCanvas() {
            let k = 0;
            while (k < 16) {
                const a = { ...this.cells[k] }

                const randIndex = Math.floor(Math.random() * 16)
                const b = { ...this.cells[randIndex] }

                this.cells[k].sx = b.sx
                this.cells[k].sy = b.sy
                this.cells[k].order = b.order

                this.cells[randIndex].sx = a.sx
                this.cells[randIndex].sy = a.sy
                this.cells[randIndex].order = a.order

                k += 1
            }

            const cellIntStartLastRow = 12;
            const cellIntEndCol = 3;
            for (let i = 0; i < 15; i++) {
                if (i % 4 != cellIntEndCol) {
                    const checkVal = (this.cells[i + 1].order) - 1;
                    if (this.cells[i].order == checkVal) {
                        return this.shuffleCanvas()
                    }
                } 
                if (i < cellIntStartLastRow) {
                    const a = i;
                    if (this.cells[a].order == (this.cells[a+4].order) - 4) {
                        return this.shuffleCanvas()
                    }
                }
            }
        },
        draw() {
            const {canvas, video} = this.elements;
            const ctx = canvas.getContext('2d')
            this.frameInterval = setInterval(() => {
                for (const item of this.cells) {
                    ctx.drawImage(video, item.sx, item.sy, item.sWidth, item.sHeight, item.dx, item.dy, item.dWidth, item.dHeight)
                }
            }, 1000 / 30)
        }
    },
    mounted() {
        this.elements.video = document.querySelector('video')
        this.elements.canvas = document.querySelector('canvas')
        const {offsetWidth, offsetHeight} = this.elements.canvas.parentElement;
        this.elements.canvas.setAttribute('width', offsetWidth)
        this.elements.canvas.setAttribute('height', offsetHeight)

        this.elements.video.addEventListener('loadeddata', async () => {
            this.buildCellsArray();
            this.shuffleCanvas() 
            this.draw()
        })
    },
}
</script>

<template>
    <canvas class="rounded shadow shadow-black"></canvas>
</template>