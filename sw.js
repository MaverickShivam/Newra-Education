const cacheName='newraedu-v10';
const staticAssets=[
    '../images/sactive1.png',
    '../images/sregister1.png',
    '../images/spending1.png',
    '../images/yoga1.png',
    '../images/sprofile2.png',
    '../images/aboutus1.png',
    'images/mylogo.png',
    '../images/filetype1.png',
    '../images/filetype2.png',
    '../images/filetype3.png',
    '../images/filetype4.png',
    '../images/filetype5.png',
    '../images/filetype6.png',
    '../images/exam.png',
    '../images/discussion.png',
    '../images/delete1.png',
    '../images/uizon.png',
    '../images/quizoff.png',
    '../images/sprofile.png',
    '../images/spending.png',
    '../images/sregister.png',
    '../images/load.gif',
    '../images/topwave-1.png'
    
    ];
self.addEventListener('install',async e =>{
    const cache=await caches.open(cacheName);
    await cache.addAll(staticAssets);
    return self.skipWaiting();
});

self.addEventListener('activate', e=>{
    self.clients.claim();
});

self.addEventListener('fetch', async e=>{
    const req=e.request;
    const url= new URL(req.url);
    if(url.origin===location.origin)
    {
        e.respondWith(cacheFirst(req));
    }
    else
    {
        e.respondWith(networkAndCache(req));
    }
});
async function cacheFirst(req)
{
    const cache = await caches.open(cacheName);
    const cached = await cache.match(req);
    return cached || fetch(req);
}
async function networkAndCache(req)
{
    const cache=await caches.open(cacheName);
    try
    {
        const fresh=await fetch(req);
        await cache.put(req,fresh.clone());
        return fresh;
    }
    catch(e)
    {
        const cached= await cache.match(req);
        return cached;
    }
}




