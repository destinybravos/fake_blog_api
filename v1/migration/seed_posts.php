<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include_once '../utils/connect.php';

try {
    // Populate the post_category table with some dummy category
    // $dummy_posts = array("Technology", "Food", "Travel", "Stock Market", "Politics", "Automobile", "Entertainment");
    $dummy_posts = getPosts();
    foreach($dummy_posts as $post) {
        if (!postExists($post['title'], $conn)) {
            // Randomely fetch user from user table
            $user = $conn->query("SELECT * FROM users ORDER BY RAND() LIMIT 1")->fetch_assoc();
            $author_id = $user['id'];
            $category_id = getCategoryID($post['category'], $conn);
            $content = str_replace("'", "\'", $post['content']);
            $title = $post['title'];
            $poster_image = $post['poster_image'];
            
            // Insert post
            $insert_sql = "INSERT INTO blogposts(title, content, author_id, category_id, poster_image) 
                                VALUES ('$title','$content','$author_id','$category_id','$poster_image')";
            $conn->query($insert_sql);
        }
    }
    $conn->close();

    // Return success
    header("HTTP/1 200");
    echo json_encode([
        'success' => true,
        'message' => 'All Posts created successfully'
    ]);
} catch (\Throwable $th) {
    header("HTTP/1 500");
    echo json_encode([
        'success' => false,
        'message' => $th->getMessage()
    ]);
}

function postExists($title, $conn){
    // Check if the category already exists
    $check_sql = "SELECT * FROM blogposts WHERE title = '$title'";
    $result = $conn->query($check_sql);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function getCategoryID($category_name, $conn){
    // Check if the category already exists
    $check_sql = "SELECT * FROM post_category WHERE category_name = '$category_name'";
    $result = $conn->query($check_sql);
    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        return $category['id'];
    } else {
        return null;
    }
}


function getPosts(){
    $posts = [
        [
            "title" => "The Future of Artificial Intelligence: Trends and Predictions",
            "category" => "Technology",
            "content" => "<h1><strong> The Future of Artificial Intelligence: Trends and Predictions </strong></h1>
                            <div style='margin-bottom: 10px;'>
                                Artificial Intelligence (AI) continues to evolve at an unprecedented pace, shaping 
                                industries, economies, and everyday life. As we look toward the future, several trends and 
                                predictions highlight the transformative potential of AI across various sectors.
                            </div>
                            <p style='margin-bottom: 10px;'>
                                <strong> 1. AI and Automation: Revolutionizing Industries  </strong> <br />
                                AI-driven automation is set to revolutionize industries, from manufacturing to healthcare. 
                                In manufacturing, AI-powered robots and predictive maintenance systems are improving efficiency 
                                and reducing downtime. In healthcare, AI is enhancing diagnostics, personalized treatment plans, 
                                and even drug discovery. By 2030, it's estimated that AI could add $13 trillion to the global 
                                economy, primarily through these efficiency gains and innovations.
                            </p>

                            <p style='margin-bottom: 10px;'>
                                <strong> 2. Advancements in Natural Language Processing (NLP) </strong> <br />
                                Natural Language Processing (NLP) is making significant strides, enabling machines to understand 
                                and generate human language with increasing accuracy. This advancement is transforming customer 
                                service through chatbots and virtual assistants, enhancing language translation services, and even 
                                improving content creation. As NLP models become more sophisticated, we can expect more seamless 
                                human-computer interactions and more intuitive AI applications.
                            </p>

                            <p style='margin-bottom: 10px;'>
                                <strong> 3. Ethics and Regulation: Navigating AI Complexities </strong> <br />
                                As AI technology advances, ethical considerations and regulatory frameworks are becoming more 
                                crucial. Issues such as data privacy, algorithmic bias, and the potential for job displacement are 
                                at the forefront of the AI debate. Governments and organizations are working to create policies that 
                                ensure AI is developed and deployed responsibly. This includes establishing guidelines for 
                                transparency, accountability, and fairness in AI systems.
                            </p>

                            <p style='margin-bottom: 10px;'>
                                <strong> 4. AI in Everyday Life: Smart Homes and Beyond </strong> <br />
                                AI is increasingly becoming a part of daily life, with smart home devices like voice-activated 
                                assistants, intelligent thermostats, and security systems becoming mainstream. Future developments 
                                could see AI integrating even more seamlessly into our homes, creating fully automated environments 
                                that adapt to our preferences and habits. Beyond the home, AI is set to enhance urban living through 
                                smart city initiatives, optimizing traffic flow, energy usage, and public safety.
                            </p>

                            <p style='margin-bottom: 10px;'>
                                AI has immense potential to address some of the world's most pressing challenges. From predicting 
                                natural disasters to optimizing resource distribution in humanitarian efforts, AI applications for 
                                social good are on the rise. Researchers and organizations are increasingly focusing on leveraging 
                                AI to combat climate change, improve healthcare in underserved regions, and enhance education
                            </p>

                            <p>
                                <strong>Conclusion</strong> <br>
                                The future of artificial intelligence is both exciting and complex, promising significant advancements 
                                and raising important ethical considerations. By embracing AI's potential while addressing its 
                                challenges, we can harness this transformative technology to create a better, more efficient, and 
                                equitable world. As AI continues to evolve, staying informed about these trends and predictions will 
                                be crucial for individuals, businesses, and policymakers alike.
                            </p>
                        ",
            "poster_image" => "/images/blog/future_ai.png"
        ],
        [
            "title" => "The Latest Gadgets for Tech Lovers: Reviews, Features, and Where to Buy",
            "category" => "Technology",
            "content" => "<h1><strong> 1. Apple iPhone 15 Pro </strong></h1>
                            <ul style='margin-bottom: 10px;'>
                                <li> <strong>Features:</strong> Apple iPhone 15 Pro is a powerful smartphone with a 6.1-inch display, powerful</li>
                                <li> <strong>Features:</strong> A16 Bionic chip, ProMotion display, enhanced camera system with ProRAW, and longer battery life.</li>
                                <li> <strong>Review:</strong> Praised for its speed, stunning display, and professional-grade camera capabilities.</li>
                                <li> <strong>Where to Buy:</strong> Available on the Apple Store and major electronics retailers like Best Buy and Amazon.</li>
                                <li><img src='https://www.istore.com.ng/cdn/shop/files/iPhone_15_Pro_Blue_Titanium_PDP_Image_Position-1__WWEN_ec505fc7-d882-43ab-a115-795bacb946b1_1200x.png?v=1697035970' style='width: 100%; max-width:120px;'></li>
                            </ul>

                            <h1><strong> 2. Samsung Galaxy Z Fold 4 </strong></h1>
                            <ul style='margin-bottom: 10px;'>
                                <li> <strong>Features:</strong> Foldable design, Snapdragon 888 processor, 12GB RAM, and multitasking capabilities.</li>
                                <li> <strong>Review:</strong> Acclaimed for its innovative foldable screen and powerful performance.</li>
                                <li> <strong>Where to Buy:</strong> Samsung's official website, and online stores such as Amazon and Newegg.</li>
                                <li><img src='https://images.samsung.com/africa_en/smartphones/galaxy-z-fold4/images/galaxy-z-fold4_highlights_kv.jpg' style='width: 100%; max-width:120px;'></li>
                            </ul>

                            <h1><strong> 3. Sony WH-1000XM5 Headphones </strong></h1>
                            <ul style='margin-bottom: 10px;'>
                                <li> <strong>Features:</strong> Industry-leading noise cancellation, superior sound quality, and long battery life </li>
                                <li> <strong>Review:</strong> Known for exceptional noise-canceling and comfort, making them ideal for travel and work.</li>
                                <li> <strong>Where to Buy:</strong> Available at Sony, Best Buy, and online platforms like Amazon.</li>
                                <li><img src='https://www.sony.com/image/6145c1d32e6ac8e63a46c912dc33c5bb?fmt=pjpeg&wid=330&bgcolor=FFFFFF&bgc=FFFFFF' style='width: 100%; max-width:120px;'></li>
                            </ul>

                            <h1><strong> 4. Apple Watch Series 9 </strong></h1>
                            <ul style='margin-bottom: 10px;'>
                                <li> <strong>Features:</strong> New health monitoring features, faster S9 chip, and improved battery life.</li>
                                <li> <strong>Review:</strong> Loved for its fitness tracking, sleek design, and seamless integration with Apple ecosystem.</li>
                                <li> <strong>Where to Buy:</strong> Available at the Apple Store, and electronics stores like Best Buy.</li>
                                <li><img src='https://www.istore.com.ng/cdn/shop/files/Apple_Watch_Series_9_GPS_45mm_Midnight_Aluminum_Midnight_Sport_Band_PDP_Image_Position-1__WWEN_1200x.png?v=1696820194' style='width: 100%; max-width:120px;'></li>
                            </ul>

                            <p>
                                <h1><strong>Conclusion</strong></h1>
                                Stay ahead in the tech game by exploring these cutting-edge gadgets. With exceptional reviews and standout features, they are must-haves for any tech enthusiast. Check out the recommended retailers to make your purchase and enjoy the latest in tech innovation.
                            </p>
                        ",
            "poster_image" => "/images/blog/gadgets.jpg"
        ],
        [
            "title" => "The Evolution of Political Campaign Strategies in the Digital Age",
            "category" => "Politics",
            "content" => "<p style='margin-bottom: 10px;'>
                                The landscape of political campaigns has undergone a seismic shift in recent years, 
                                driven largely by advances in digital technology and social media. Traditional methods of 
                                canvassing, television ads, and direct mail have been supplemented, and in some cases, 
                                supplanted by sophisticated digital strategies. This evolution has transformed how candidates 
                                communicate with voters, how campaigns are managed, and how elections are won and lost.
                            </p>
                            
                            <h3><strong> The Rise of Social Media in Politics </strong></h3>
                            <p style='margin-bottom: 10px;'>
                                Social media platforms like Facebook, Twitter, and Instagram have become indispensable tools for 
                                political campaigns. They provide candidates with a direct line to voters, bypassing traditional 
                                media gatekeepers. The immediacy and reach of social media allow for real-time engagement and 
                                feedback, creating a more interactive political environment.
                            </p>
                            <p style='margin-bottom: 10px;'>
                                <strong>Example:</strong> During the 2020 US Presidential election, both major candidates utilized 
                                Twitter extensively to communicate their messages, respond to current events, and rally their base. 
                                The platforms allowed for rapid dissemination of information and mobilization of supporters.
                            </p>
                            
                            <h3><strong> Data-Driven Campaigns </strong></h3>
                            <p style='margin-bottom: 10px;'>
                                The use of big data analytics has revolutionized political campaigns. By analyzing vast amounts of 
                                data from various sources, campaigns can identify and target specific voter demographics with tailored 
                                messages. This precision targeting enhances the efficiency of campaign efforts and ensures that 
                                resources are allocated where they are most likely to be effective.
                            </p>
                            <p style='margin-bottom: 10px;'>
                                <strong>Example:</strong> Barack Obama's 2012 re-election campaign is often cited as a pioneering use of data analytics. The campaign used data to micro-target voters and personalize outreach efforts, contributing significantly to his victory.
                            </p>
                            
                            <h3><strong> Digital Advertising and Microtargeting </strong></h3>
                            <p style='margin-bottom: 10px;'>
                                Digital advertising, particularly on social media and search engines, has become a cornerstone of modern political campaigns. These platforms allow for highly targeted ads that can reach specific demographics based on age, location, interests, and even online behavior. This level of targeting is far more precise than traditional media advertising.
                            </p>
                            <p style='margin-bottom: 10px;'>
                                <strong>Example:</strong> In the 2016 US Presidential election, digital advertising played a crucial role. Both the Trump and Clinton campaigns invested heavily in Facebook ads, using detailed targeting to reach undecided voters in key swing states.
                            </p>
                        ",
            "poster_image" => "/images/blog/digital_politics.png"
        ],
        [
            "title" => "Binge Worthy: Top 3 Shows to Devour This Weekend",
            "category" => "Entertainment",
            "content" => "<div style='margin-bottom: 10px;'>
                                Feeling stuck in a post-work slump and craving a screen escape? We've all been there. Fear not, fellow entertainment enthusiasts! Here are 3 addictive shows, across different platforms, guaranteed to keep you glued to the couch (or bed) this weekend:
                            </div>
                            <p style='margin-bottom: 10px;'>
                                <strong> 1. For the Reality TV Junkie:  </strong> <br />
                                'Rival Restaurateurs' (Streaming Service X) - This fiery new competition series throws two culinary rivals head-to-head, each running a pop-up restaurant for a week. The audience decides whose creation reigns supreme! Expect drama in the kitchen, sabotage attempts, and of course, delicious food close-ups.
                            </p>

                            <p style='margin-bottom: 10px;'>
                                <strong> 2. For the Sci-Fi Fanatic: </strong> <br />
                                'Lightyears' (Network TV) - This spacefaring drama follows a ragtag crew on a generational mission to find a new home for humanity. Think 'Firefly' meets 'Westworld' with stunning visuals and thought-provoking questions about survival and the human spirit.
                            </p>

                            <p style='margin-bottom: 10px;'>
                                <strong> 3. For the True Crime Buff: </strong> <br />
                                'Unsolved: The Silicon Valley Enigma' (Streaming Service Y) - This gripping docuseries delves into the unsolved disappearance of a tech billionaire, with shocking twists, intriguing interviews, and enough tech jargon to keep you guessing.
                            </p>

                            <p style='margin-bottom: 10px;'>
                                So grab your snacks, dim the lights, and get ready to be entertained!
                            </p>

                            <p style='margin-bottom: 10px;'>
                                <strong>Bonus Tip:</strong> Check out the reviews for these shows to see which one piques your interest the most. Happy watching!
                            </p>
                        ",
            "poster_image" => "/images/blog/binge_watch.avif"
        ],
        [
            "title" => "Navigating the Stock Market: A Beginners Guide",
            "category" => "Stock Market",
            "content" => "<p style='margin-bottom: 10px;'>
                                The stock market can seem like a complex and intimidating place, filled with jargon and rapid-fire ticker movements. But fear not, aspiring investor! This article is your launchpad for understanding the basics of the stock market and taking your first steps.
                            </p>
                            <h1><strong> The Marketplace: </strong></h1>
                            <div style='margin-bottom: 10px;'>
                                Imagine a giant marketplace where companies sell tiny pieces of ownership (called stocks) to raise capital. Investors, like yourself, buy these stocks hoping their value will increase over time. When a company does well, its stock price typically goes up, and you can potentially sell it for a profit.
                            </div>

                            <h3><strong> The Key Players: </strong></h3>
                            <p style='margin-bottom: 10px;'>
                                <ul>
                                    <li>
                                        <strong>Companies:</strong> The businesses issuing the stock, hoping to raise money for growth and operations.
                                    </li>
                                    <li>
                                        <strong>Investors:</strong> Individuals or institutions buying stocks with the aim of profiting from their increase in value.
                                    </li>
                                    <li>
                                        <strong>Stock Exchanges:</strong> Regulated marketplaces where stocks are traded, like the Nigerian Stock Exchange (NGX).
                                    </li>
                                </ul>
                            </p>

                            <h3><strong> Understanding Stock Prices: </strong></h3>
                            <div style='margin-bottom: 10px;'>
                                Imagine a giant marketplace where companies sell tiny pieces of ownership (called stocks) to raise capital. Investors, like yourself, buy these stocks hoping their value will increase over time. When a company does well, its stock price typically goes up, and you can potentially sell it for a profit.
                            </div>

                            <h3><strong> Investing Tips for Beginners: </strong></h3>
                            <p style='margin-bottom: 10px;'>
                                <ul>
                                    <li>
                                        <strong>Do your research:</strong>  Before buying a stock, research the company, its financials, and its industry.
                                    </li>
                                    <li>
                                        <strong>Start small and diversify:</strong> Don't invest a huge chunk of your savings upfront. Spread your investments across different companies to minimize risk.
                                    </li>
                                    <li>
                                        <strong>Consider a long-term approach:</strong> The stock market can be volatile in the short term. Focus on companies with solid potential for long-term growth.
                                    </li>
                                    <li>
                                        <strong>Be patient:</strong> Don't expect to get rich quick. Building wealth through the stock market takes time and discipline.
                                    </li>
                                </ul>
                            </p>

                            <p>
                                <strong>Remember: </strong> <br>
                                This is just a starting point. There's always more to learn about the stock market. Consider consulting a financial advisor for personalized guidance tailored to your financial goals.
                            </p>
                        ",
            "poster_image" => "/images/blog/stock_market.jpg"
        ]
    ];

    return $posts;
}
