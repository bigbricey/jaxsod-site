<?php 
/* 
 * San Jose neighborhood-specific landing page
 */

$neighborhood = "San Jose"; 
$neighborhoodLower = strtolower($neighborhood); 
$neighborhoodServiceArea = "South Jacksonville"; 

$pageTitle = "Professional Sod Installation in {$neighborhood}, Jacksonville FL | Jax Sod Inc.";
$pageDescription = "Expert sod installation services in {$neighborhood}, Jacksonville. Local sod specialists with 37+ years of experience serving {$neighborhood} homes and businesses. Free estimates.";
include("header.php"); 
?>

<div class="container page-content">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <h1 class="text-center">Professional Sod Installation in <?php echo $neighborhood; ?>, Jacksonville</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="services.php">Services</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $neighborhood; ?></li>
                </ol>
            </nav>
            <p class="lead text-center">Jacksonville's trusted sod installation experts serving <?php echo $neighborhood; ?> properties for over 37 years.</p>
        </div>
    </div>
    
    <section class="neighborhood-intro mt-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2><?php echo $neighborhood; ?>'s Premier Sod Installation Service</h2>
                <p>At Jax Sod Inc., we provide expert sod installation services throughout <?php echo $neighborhood; ?> and the surrounding areas. Our team understands the unique soil conditions, climate challenges, and landscaping preferences specific to <?php echo $neighborhood; ?> properties.</p>
                <p>San Jose, with its historic charm and beautiful landscapes, features distinctive characteristics that require specialized lawn care approaches. This established neighborhood is known for its magnificent oak trees, including live oaks with their sprawling canopies draped in Spanish moss, creating significant shade patterns across many properties. The area's mix of midcentury modern homes alongside historic Mediterranean Revival residences creates a unique blend of landscaping needs and challenges.</p>
                <p>Our <?php echo $neighborhood; ?> customers enjoy personalized service, premium sod varieties selected for their specific property conditions, and installation expertise developed over decades of serving this community.</p>
                <a href="contact.php" class="btn btn-primary">Get a Free <?php echo $neighborhood; ?> Estimate</a>
            </div>
            <div class="col-lg-6">
                <img src="images/residential-sod-installation.jpg" alt="Professional sod installation in <?php echo $neighborhood; ?>, Jacksonville" class="img-fluid rounded shadow">
            </div>
        </div>
    </section>
    
    <section class="neighborhood-services mt-5">
        <h2 class="text-center mb-4">Our <?php echo $neighborhood; ?> Sod Installation Services</h2>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3><i class="fas fa-home text-primary me-2"></i> Residential Sod Installation in <?php echo $neighborhood; ?></h3>
                        <p>Transform your <?php echo $neighborhood; ?> home's landscape with a beautiful new lawn professionally installed by Jacksonville's sod experts. Our residential sod installation services include:</p>
                        <ul>
                            <li><strong>Complete Yard Installation</strong> - Transform your entire lawn with fresh, healthy sod</li>
                            <li><strong>Partial Lawn Renovation</strong> - Replace damaged or bare sections of your existing lawn</li>
                            <li><strong>New Home Construction</strong> - Install the finishing touch on your newly built home in <?php echo $neighborhood; ?></li>
                            <li><strong>Small Area Installation</strong> - Perfect for courtyards, side yards, or small spaces</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3><i class="fas fa-building text-primary me-2"></i> Commercial Sod Installation in <?php echo $neighborhood; ?></h3>
                        <p>Enhance your <?php echo $neighborhood; ?> business property's appearance and value with professional sod installation. We work with a variety of <?php echo $neighborhood; ?> commercial clients, including:</p>
                        <ul>
                            <li><strong>Office Complexes</strong> - Create an inviting, professional environment</li>
                            <li><strong>Retail Properties</strong> - Improve curb appeal to attract customers</li>
                            <li><strong>Homeowners Associations</strong> - Maintain beautiful common areas in <?php echo $neighborhood; ?> communities</li>
                            <li><strong>Apartment Communities</strong> - Enhance grounds and outdoor spaces</li>
                            <li><strong>Municipal Properties</strong> - Beautify public spaces and facilities</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="neighborhood-features mt-5">
        <h2 class="text-center"><?php echo $neighborhood; ?> Lawn Considerations</h2>
        <p class="text-center mb-4">Understanding the unique characteristics of <?php echo $neighborhood; ?> properties for optimal sod installation results</p>
        
        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3><i class="fas fa-leaf text-primary me-2"></i> <?php echo $neighborhood; ?> Landscape Features</h3>
                        <p>San Jose landscapes often feature magnificent oak trees, particularly live oaks with their expansive canopies spreading up to 150 feet wide and draped with Spanish moss. These create significant shade patterns that require careful consideration when selecting grass varieties.</p>
                        <p>The neighborhood's mix of historic homes and midcentury modern residences creates varied landscaping styles, from formal Mediterranean-inspired gardens to more contemporary designs. Many properties feature mature landscaping that requires expert care during sod installation to protect existing plants and trees.</p>
                        <p>Some areas of San Jose have soil with higher clay content, which can affect drainage and requires proper site preparation before sod installation. Properties closer to the St. Johns River may have different soil conditions than those further inland, necessitating customized approaches to ensure successful sod establishment.</p>
                        <p>Our installation team has extensive experience working with these specific conditions to ensure your new sod establishes properly and thrives in your <?php echo $neighborhood; ?> property.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3><i class="fas fa-seedling text-primary me-2"></i> Recommended Sod Types for <?php echo $neighborhood; ?></h3>
                        <p>Based on our decades of experience installing sod in <?php echo $neighborhood; ?>, we typically recommend these grass varieties for optimal results in this area:</p>
                        <ul>
                            <li><strong>St. Augustine Palmetto</strong> - Superior shade tolerance for properties with mature oak trees, ideal for many San Jose yards</li>
                            <li><strong>St. Augustine Floratam</strong> - Excellent for open, sunny areas of San Jose properties</li>
                            <li><strong>Zoysia</strong> - Perfect for high-traffic areas or homeowners wanting a more manicured look, with good drought resistance</li>
                            <li><strong>St. Augustine Seville</strong> - Finer texture with good shade tolerance for more refined landscapes</li>
                            <li><strong>Centipede</strong> - Lower maintenance option for larger properties with acidic soil conditions</li>
                        </ul>
                        <p>During your consultation, we'll assess your specific property conditions to recommend the perfect sod variety for your needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="testimonials mt-5 bg-light p-5 rounded">
        <h2 class="text-center mb-4">What <?php echo $neighborhood; ?> Residents Say About Our Service</h2>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text">"Jax Sod transformed our San Jose property that had been struggling with patchy grass under our massive oak trees. Their team recommended the perfect shade-tolerant St. Augustine variety and carefully worked around our tree roots and existing landscaping. Six months later, our lawn still looks incredible and has required minimal maintenance compared to our previous grass."</p>
                        <p class="testimonial-author">— Robert & Emily Jacobson, <?php echo $neighborhood; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="neighborhood-faqs mt-5">
        <h2 class="text-center mb-4">Frequently Asked Questions About <?php echo $neighborhood; ?> Sod Installation</h2>
        <div class="accordion" id="neighborhoodFaqAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What are the best grass types for <?php echo $neighborhood; ?> properties?
                    </button>
                </h3>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#neighborhoodFaqAccordion">
                    <div class="accordion-body">
                        <?php echo $neighborhood; ?> properties typically do well with St. Augustine varieties like Floratam and Palmetto due to their excellent shade tolerance and ability to thrive in our local soil conditions. Zoysia is another excellent choice, particularly for yards with higher foot traffic or more sun exposure. During your consultation, we'll evaluate your specific property conditions to recommend the perfect grass variety.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How much does sod installation cost in <?php echo $neighborhood; ?>?
                    </button>
                </h3>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#neighborhoodFaqAccordion">
                    <div class="accordion-body">
                        Sod installation costs in <?php echo $neighborhood; ?> typically range from $1.75-$3.50 per square foot, depending on factors like sod variety, yard size, current lawn condition, and accessibility. This includes removal of old grass, soil preparation, premium sod materials, and expert installation. We provide free, detailed estimates for all <?php echo $neighborhood; ?> properties with transparent pricing and no hidden fees.
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h3 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Are there any special considerations for <?php echo $neighborhood; ?> lawns?
                    </button>
                </h3>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#neighborhoodFaqAccordion">
                    <div class="accordion-body">
                        <?php echo $neighborhood; ?> properties often have significant shade from mature oak trees, which requires careful grass variety selection. The neighborhood's varied soil conditions, from sandy to areas with higher clay content, may need specific preparation techniques. Many San Jose homes have established landscaping and irrigation systems that need to be carefully worked around during installation. Our team is familiar with these local conditions and incorporates appropriate solutions during the installation process to ensure your new lawn establishes properly and thrives long-term.
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="local-areas-served mt-5">
        <h2 class="text-center">Areas We Serve Near <?php echo $neighborhood; ?></h2>
        <p class="text-center mb-4">Our sod installation services extend throughout <?php echo $neighborhood; ?> and nearby areas</p>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-primary me-2"></i> <?php echo $neighborhood; ?></li>
                                    <li><i class="fas fa-check text-primary me-2"></i> San Jose Forest</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Mandarin</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> San Marco</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li><i class="fas fa-check text-primary me-2"></i> Beauclerc</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Baymeadows</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Ortega</li>
                                    <li><i class="fas fa-check text-primary me-2"></i> Surrounding <?php echo $neighborhoodServiceArea; ?> Areas</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="cta-section bg-primary text-white p-5 rounded mt-5">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2>Ready to Transform Your <?php echo $neighborhood; ?> Property?</h2>
                <p class="lead mb-0">Contact Jax Sod Inc. today to schedule your free sod installation consultation and estimate.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="contact.php" class="btn btn-light btn-lg">Get Your Free Estimate</a>
            </div>
        </div>
    </section>
</div>

<!-- Schema Markup for <?php echo $neighborhood; ?> Sod Installation Service -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "serviceType": "Sod Installation in <?php echo $neighborhood; ?>",
  "provider": {
    "@type": "LocalBusiness",
    "name": "Jax Sod Inc.",
    "address": {
      "@type": "PostalAddress",
      "addressLocality": "Jacksonville",
      "addressRegion": "FL"
    }
  },
  "areaServed": {
    "@type": "City",
    "name": "<?php echo $neighborhood; ?>",
    "containedIn": {
      "@type": "City",
      "name": "Jacksonville"
    }
  },
  "description": "Professional sod installation services for homes and businesses in <?php echo $neighborhood; ?>, Jacksonville, FL. Transform your property with expert sod installation from Jax Sod Inc.",
  "offers": {
    "@type": "Offer",
    "availability": "https://schema.org/InStock",
    "priceSpecification": {
      "@type": "PriceSpecification",
      "priceCurrency": "USD"
    }
  }
}
</script>

<?php
// Generate FAQ Schema
include_once('faq-schema.php');

$faqs = [
    "What are the best grass types for {$neighborhood} properties?" => "{$neighborhood} properties typically do well with St. Augustine varieties like Floratam and Palmetto due to their excellent shade tolerance and ability to thrive in our local soil conditions. Zoysia is another excellent choice, particularly for yards with higher foot traffic or more sun exposure.",
    
    "How much does sod installation cost in {$neighborhood}?" => "Sod installation costs in {$neighborhood} typically range from $1.75-$3.50 per square foot, depending on factors like sod variety, yard size, current lawn condition, and accessibility. This includes removal of old grass, soil preparation, premium sod materials, and expert installation.",
    
    "Are there any special considerations for {$neighborhood} lawns?" => "{$neighborhood} properties often have significant shade from mature oak trees, which requires careful grass variety selection. The neighborhood's varied soil conditions, from sandy to areas with higher clay content, may need specific preparation techniques.",
    
    "How long does sod installation take in {$neighborhood}?" => "Most {$neighborhood} residential sod installation projects can be completed in 1-2 days, depending on the size and complexity of your yard. Small to medium-sized installations are typically completed in a single day, while larger properties may require additional time."
];

echo generate_faq_schema($faqs);
?>

<?php include("footer.php"); ?>