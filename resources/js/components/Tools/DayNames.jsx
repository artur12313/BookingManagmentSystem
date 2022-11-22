export default function DayNames({dayName}) {
    switch(dayName) {
        case 'Mon': return dayName = 'Pon';
        case 'Tue': return dayName = 'Wto';
        case 'Wed': return dayName = 'Śro';
        case 'Thu': return dayName = 'Czw';
        case 'Fri': return dayName = 'Pią';
        case 'Sat': return dayName = 'Sob';
        case 'Sun': return dayName = 'Nie';
    }
}
        